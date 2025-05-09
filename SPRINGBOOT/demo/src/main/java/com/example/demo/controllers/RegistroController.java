package com.example.demo.controllers;

import java.sql.*;

import org.springframework.web.bind.annotation.GetMapping;
import org.springframework.web.bind.annotation.RequestMapping;
import org.springframework.web.bind.annotation.RequestParam;
import org.springframework.web.bind.annotation.RestController;

import com.fasterxml.jackson.databind.ObjectMapper;
import com.fasterxml.jackson.databind.node.ObjectNode;

@RestController
@RequestMapping("/terminal") //127.0.0.1:8080/terminal
public class RegistroController {

    final String DB_URL = "jdbc:mysql://127.0.0.1/inftec";
	final String USER = "root";
	final String PASS = "";
	private ObjectMapper mapper=new ObjectMapper();
    
    @GetMapping("/registraRitiro.php")
	public ObjectNode registraRitiro(@RequestParam int idRitirante, @RequestParam int idBuono) {
		try (Connection conn = DriverManager.getConnection(DB_URL, USER, PASS)) {
            String q = "INSERT INTO registro (id_ritirante, id_buono) VALUES (?, ?)";
            PreparedStatement ris = conn.prepareStatement(q);
            ris.setInt(1, idRitirante);
            ris.setInt(2, idBuono);
            ris.executeUpdate();

			ObjectNode obj=mapper.createObjectNode();
			obj.put("error", "OK");
			return obj;

        } catch (SQLException e) {
			ObjectNode obj=mapper.createObjectNode();
			obj.put("error", e.toString());
			return obj;

        }
	}
}
