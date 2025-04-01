
package server

import (
	"fmt"
	"golang.org/x/net/websocket"
)

type Server struct {
	conns map[*websocket.Conn]bool
	users map[string]*websocket.Conn
	allowedSend map[string]string
	sendQueue map[string]*SendQueue
}

func NewServer() *Server {
	return &Server{
		conns: make(map[*websocket.Conn]bool),
		users: make(map[string]*websocket.Conn),
        sendQueue: make(map[string]*SendQueue),
        allowedSend: make(map[string]string),
	}
}

func (s *Server) removeConnection(ws *websocket.Conn) {
	delete(s.conns, ws)
	for userID, conn := range s.users {
		if conn == ws {
            s.broadcastResponse(Response{
                Type:    "leave",
                Status:  "userLeft",
                Message: fmt.Sprintf("User %s left", userID),
                Data:    userID,
            })
			delete(s.users, userID)
			break
		}
	}
    for key, sendQueue := range s.sendQueue {
        if (sendQueue.receiver == ws || sendQueue.sender == ws) {
            delete(s.sendQueue, key)
        }
    }
	ws.Close()
}

func WSHandler(s *Server) websocket.Handler {
	return func(ws *websocket.Conn) {
		fmt.Println("new incomming connection from client", ws.RemoteAddr())
		s.conns[ws] = true
		s.readLoop(ws)
	}
}
