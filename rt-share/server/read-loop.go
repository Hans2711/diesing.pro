package server

import (
	"bytes"
	"encoding/json"
	"fmt"
	"io"
	"golang.org/x/net/websocket"
)

func (s *Server) readLoop(ws *websocket.Conn) {
	buf := make([]byte, 1024)
	var partialMsg []byte

	for {
		n, err := ws.Read(buf)
		if err != nil {
			if err == io.EOF {
				s.removeConnection(ws)
				break
			}
			fmt.Println("read error:", err)
			continue
		}

		partialMsg = append(partialMsg, buf[:n]...)
        // fmt.Println(string(partialMsg))

		for {
			idx := bytes.IndexByte(partialMsg, '\n')
			if idx == -1 {
				break
			}

			msg := partialMsg[:idx]
			partialMsg = partialMsg[idx+1:]

            // fmt.Println(string(msg))

			var req Request
			err := json.Unmarshal(msg, &req)
			if err != nil {
				fmt.Println("invalid JSON:", string(msg))
				continue
			}

			res, err := s.handleMessage(req, ws)
			if err != nil {
				fmt.Println("request parse error", err)
				continue
			}

			resJSON, err := res.toJson()
			if err != nil {
				fmt.Println("request JSON parse error", err)
				continue
			}

            // fmt.Println(string(resJSON))

			if _, err := ws.Write(resJSON); err != nil {
				fmt.Println("write error:", err)
				s.removeConnection(ws)
			}
		}
	}
}

