package server

import (
    "encoding/json"
)

func (s *Server) getAllUserIDsJSON() string {
	var ids []string
	for id := range s.users {
		ids = append(ids, id)
	}
	jsonBytes, err := json.Marshal(ids)
	if err != nil {
		return "[]"
	}
	return string(jsonBytes)
}

