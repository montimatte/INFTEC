package com.example.demo.controllers;

import java.sql.*;

import org.springframework.web.bind.annotation.GetMapping;
import org.springframework.web.bind.annotation.RequestMapping;
import org.springframework.web.bind.annotation.RequestParam;
import org.springframework.web.bind.annotation.RestController;

import com.fasterxml.jackson.databind.ObjectMapper;
import com.fasterxml.jackson.databind.node.ArrayNode;
import com.fasterxml.jackson.databind.node.ObjectNode;

@RestController
@RequestMapping("/terminal") //127.0.0.1:8080/terminal
public class BuonoController {

    final String DB_URL = "jdbc:mysql://127.0.0.1/inftec";
	final String USER = "root";
	final String PASS = "";
	private ObjectMapper mapper=new ObjectMapper();

    @GetMapping("/inviaRichiestaBuono.php")
	public ObjectNode inviaRichiestaBuono(@RequestParam int idUtente, @RequestParam int idRitirante, @RequestParam int idPolizza, @RequestParam double peso) {
		try (Connection conn = DriverManager.getConnection(DB_URL, USER, PASS)) {
            String q = "INSERT INTO buono (id_cliente, id_ritirante, peso, id_polizza) VALUES (?, ?, ?, ?)";
            PreparedStatement ris = conn.prepareStatement(q);
            ris.setInt(1, idUtente);
            ris.setInt(2, idRitirante);
            ris.setDouble(3, peso);
            ris.setInt(4, idPolizza);
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

	@GetMapping("/getBuoniUtente.php")
	public ObjectNode getBuoniUtente(@RequestParam int idUtente) {
		try (Connection conn = DriverManager.getConnection(DB_URL, USER, PASS)) {
            String q = "SELECT * FROM buono JOIN utente ON utente.id=buono.id_cliente JOIN polizza ON polizza.id=buono.id_polizza WHERE buono.id_ritirante=? AND buono.stato=?";
            PreparedStatement ris = conn.prepareStatement(q);
			ris.setInt(1, idUtente);
			ris.setString(2, "accettato");
            ResultSet row=ris.executeQuery();

			ObjectNode obj=mapper.createObjectNode();
			ArrayNode array=obj.putArray("buoni");			
			while(row.next()){
				int id=row.getInt("buono.id");
				String cliente=row.getNString("utente.username");
				int id_polizza=row.getInt("buono.id_polizza");
				String merce=row.getString("polizza.tipologiaMerce");
				double peso=row.getDouble("buono.peso");

				ObjectNode buono=mapper.createObjectNode();
				buono.put("id", id);
				buono.put("cliente", cliente);
				buono.put("id_polizza", id_polizza);
				buono.put("tipologiaMerce", merce);
				buono.put("peso", peso);
				array.add(buono);

			}
			return obj;

        } catch (SQLException e) {
			ObjectNode obj=mapper.createObjectNode();
			obj.put("error", e.toString());
			return obj;
        }
	}
	
	@GetMapping("/getBuoniByStato.php")
	public ObjectNode getBuoniByStato(@RequestParam String stato) {
		try (Connection conn = DriverManager.getConnection(DB_URL, USER, PASS)) {
            String q = "SELECT * FROM buono JOIN utente ON utente.id=buono.id_cliente JOIN polizza ON polizza.id=buono.id_polizza WHERE buono.stato=?";
            PreparedStatement ris = conn.prepareStatement(q);
			ris.setString(1, stato);
            ResultSet row=ris.executeQuery();

			ObjectNode obj=mapper.createObjectNode();
			ArrayNode array=obj.putArray("buoni");			
			while(row.next()){
				int id=row.getInt("buono.id");
				String cliente=row.getNString("utente.username");
				int id_polizza=row.getInt("buono.id_polizza");
				String merce=row.getString("polizza.tipologiaMerce");
				double peso=row.getDouble("buono.peso");

				ObjectNode buono=mapper.createObjectNode();
				buono.put("id", id);
				buono.put("cliente", cliente);
				buono.put("id_polizza", id_polizza);
				buono.put("tipologiaMerce", merce);
				buono.put("peso", peso);
				array.add(buono);

			}
			return obj;

        } catch (SQLException e) {
			ObjectNode obj=mapper.createObjectNode();
			obj.put("error", e.toString());
			return obj;
        }
	}

	@GetMapping("/updateBuono.php")
	public ObjectNode updateBuono(@RequestParam int id, @RequestParam String stato) {
		try (Connection conn = DriverManager.getConnection(DB_URL, USER, PASS)) {
			String q = "UPDATE buono SET stato=? WHERE id=?";
			PreparedStatement ris = conn.prepareStatement(q);
			ris.setString(1, stato);
			ris.setInt(2, id);
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
