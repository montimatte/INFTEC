package com.example.demo.controllers;

import java.sql.*;

import org.springframework.web.bind.annotation.GetMapping;
import org.springframework.web.bind.annotation.RequestMapping;
import org.springframework.web.bind.annotation.RequestParam;
import org.springframework.web.bind.annotation.RestController;

import com.example.classes.Polizza;
import com.fasterxml.jackson.databind.ObjectMapper;
import com.fasterxml.jackson.databind.node.ArrayNode;
import com.fasterxml.jackson.databind.node.ObjectNode;

@RestController
@RequestMapping("/terminal") //127.0.0.1:8080/terminal
public class PolizzaController {

    final String DB_URL = "jdbc:mysql://127.0.0.1/inftec";
	final String USER = "root";
	final String PASS = "";
	private ObjectMapper mapper=new ObjectMapper();


    @GetMapping("/getPolizze.php")
	public ObjectNode getPolizze() {
		try (Connection conn = DriverManager.getConnection(DB_URL, USER, PASS)) {
            String q = "SELECT * FROM polizza";
            PreparedStatement ris = conn.prepareStatement(q);
            ResultSet row=ris.executeQuery();

			ObjectNode obj=mapper.createObjectNode();
			ArrayNode array=obj.putArray("polizze");			
			while(row.next()){
				int id=row.getInt("id");
				int id_viaggio=row.getInt("id_viaggio");
				String tipologiaMerce=row.getString("tipologiaMerce");
				double peso=row.getDouble("peso");
				String fornitore=row.getString("fornitore");
				int giorniMagazzinaggio=row.getInt("giorniMagazzinaggio");
				double tariffa=row.getDouble("tariffa");
				Polizza p=new Polizza(id, id_viaggio, tipologiaMerce, peso, fornitore, giorniMagazzinaggio, tariffa);

				array.addPOJO(p);

			}
			return obj;

        } catch (SQLException e) {
			ObjectNode obj=mapper.createObjectNode();
			obj.put("error", e.toString());
			return obj;
        }
	}

	@GetMapping("/getPolizzaById.php")
	public ObjectNode getPolizzaById(@RequestParam int id) {
		try (Connection conn = DriverManager.getConnection(DB_URL, USER, PASS)) {
            String q = "SELECT * FROM polizza WHERE id=?";
            PreparedStatement ris = conn.prepareStatement(q);
            ris.setInt(1, id);
            ResultSet row=ris.executeQuery();
			row.next();

			int idd=row.getInt("id");
			int id_viaggio=row.getInt("id_viaggio");
			String tipologiaMerce=row.getString("tipologiaMerce");
			double peso=row.getDouble("peso");
			String fornitore=row.getString("fornitore");
			int giorniMagazzinaggio=row.getInt("giorniMagazzinaggio");
			double tariffa=row.getDouble("tariffa");

			ObjectNode polizza=mapper.createObjectNode();
			Polizza p=new Polizza(idd, id_viaggio, tipologiaMerce, peso, fornitore, giorniMagazzinaggio, tariffa);
			polizza.putPOJO("polizza", p);
			
			return polizza;

        } catch (SQLException e) {
			ObjectNode obj=mapper.createObjectNode();
			obj.put("error", e.toString());
			return obj;
        }
	}

	@GetMapping("/getQuantitaRichiestaPolizza.php")
	public ObjectNode getQuantitaRichiestaPolizza(@RequestParam int idPolizza) {
		try (Connection conn = DriverManager.getConnection(DB_URL, USER, PASS)) {
            String q = "SELECT SUM(peso) AS totale FROM `buono` WHERE stato != ? AND id_polizza=?";
            PreparedStatement ris = conn.prepareStatement(q);
            ris.setString(1, "rifiutato");
            ris.setInt(2, idPolizza);
            ResultSet row=ris.executeQuery();
			row.next();

			double tot=row.getInt("totale");
			ObjectNode obj=mapper.createObjectNode();
			obj.put("totale", tot);

			return obj;

        } catch (SQLException e) {
			ObjectNode obj=mapper.createObjectNode();
			obj.put("error", e.toString());
			return obj;
        }
	}
	
}
