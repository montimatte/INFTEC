package com.example.demo.controllers;

import java.sql.*;
import java.time.LocalDateTime;

import org.springframework.web.bind.annotation.GetMapping;
import org.springframework.web.bind.annotation.RequestMapping;
import org.springframework.web.bind.annotation.RequestParam;
import org.springframework.web.bind.annotation.RestController;

import com.example.classes.Buono;
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
	
	@GetMapping("/getBuoniCliente.php")
	public ObjectNode getBuoniCliente(@RequestParam int idUtente) {
		try (Connection conn = DriverManager.getConnection(DB_URL, USER, PASS)) {
            String q = "SELECT * FROM buono JOIN ritirante ON ritirante.id=buono.id_ritirante JOIN utente ON ritirante.id=utente.id JOIN polizza ON polizza.id=buono.id_polizza WHERE buono.id_cliente=?";
            PreparedStatement ris = conn.prepareStatement(q);
			ris.setInt(1, idUtente);
            ResultSet row=ris.executeQuery();

			ObjectNode obj=mapper.createObjectNode();
			ArrayNode array=obj.putArray("buoni");			
			while(row.next()){
				int id=row.getInt("buono.id");
				String autotrasportatore=row.getString("utente.username");
				String targa=row.getString("ritirante.id_camion");
				int id_polizza=row.getInt("buono.id_polizza");
				String merce=row.getString("polizza.tipologiaMerce");
				double peso=row.getDouble("buono.peso");
				String stato=row.getString("buono.stato");

				Buono b=new Buono(id,"",0,peso,id_polizza,merce,stato,targa,autotrasportatore);
				array.addPOJO(b);

			}
			return obj;

        } catch (SQLException e) {
			ObjectNode obj=mapper.createObjectNode();
			obj.put("error", e.toString());
			return obj;
        }
	}

	@GetMapping("/getBuoniAutotrasportatore.php")
	public ObjectNode getBuoniAutotrasportatore(@RequestParam int idUtente) {
		try (Connection conn = DriverManager.getConnection(DB_URL, USER, PASS)) {
			String q="SELECT * FROM buono JOIN utente u1 ON u1.id=buono.id_cliente JOIN polizza ON polizza.id=buono.id_polizza JOIN ritirante ON ritirante.id=buono.id_ritirante JOIN utente u2 ON u2.id=ritirante.id_conducente WHERE buono.stato=? AND u2.id=?";
            PreparedStatement ris = conn.prepareStatement(q);
			ris.setString(1, "accettato");
			ris.setInt(2, idUtente);
            ResultSet row=ris.executeQuery();

			ObjectNode obj=mapper.createObjectNode();
			ArrayNode array=obj.putArray("buoni");			
			while(row.next()){
				int id=row.getInt("buono.id");
				String cliente=row.getString("u1.username");
				int id_polizza=row.getInt("buono.id_polizza");
				String merce=row.getString("polizza.tipologiaMerce");
				double peso=row.getDouble("buono.peso");

				Buono b=new Buono(id, cliente, 0, peso, id_polizza, merce, "", "", "");
				array.addPOJO(b);

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
            String q = "SELECT * FROM buono JOIN utente u1 ON u1.id=buono.id_cliente JOIN polizza ON polizza.id=buono.id_polizza JOIN ritirante ON ritirante.id=buono.id_ritirante JOIN utente u2 ON u2.id=ritirante.id_conducente WHERE buono.stato=?";
            PreparedStatement ris = conn.prepareStatement(q);
			ris.setString(1, stato);
            ResultSet row=ris.executeQuery();

			ObjectNode obj=mapper.createObjectNode();
			ArrayNode array=obj.putArray("buoni");			
			while(row.next()){
				int id=row.getInt("buono.id");
				String cliente=row.getNString("u1.username");
				int id_polizza=row.getInt("buono.id_polizza");
				String merce=row.getString("polizza.tipologiaMerce");
				double peso=row.getDouble("buono.peso");
				String targa=row.getString("ritirante.id_camion");
				String autotrasportatore=row.getString("u2.username");

				Buono b=new Buono(id, cliente, 0, peso, id_polizza, merce, stato, targa, autotrasportatore);
				array.addPOJO(b);
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
			String q;
			PreparedStatement ris;
			if(stato.equals("accettato")){
				q = "UPDATE buono SET stato=? , dataOraApprovazione=? WHERE id=?";
				ris = conn.prepareStatement(q);
				ris.setString(1, stato);
				ris.setTimestamp(2, Timestamp.valueOf(LocalDateTime.now()));
				ris.setInt(3, id);
			}
			else{
				q = "UPDATE buono SET stato=? WHERE id=?";
				ris = conn.prepareStatement(q);
				ris.setString(1, stato);
				ris.setInt(2, id);
			}
			
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
