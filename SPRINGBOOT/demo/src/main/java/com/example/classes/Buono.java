package com.example.classes;

public class Buono {
    private int id;
    private String cliente;
    private int id_ritirante;
    private String targa;
    private String autotrasportatore;
    private double peso;
    private int id_polizza;
    private String tipologiaMerce;
    private String stato;

    public Buono(int id, String cliente, int id_ritirante, double peso, int id_polizza, String tipologiaMerce, String stato, String targa, String autotrasportatore) {
        this.id = id;
        this.cliente = cliente;
        this.id_ritirante = id_ritirante;
        this.peso = peso;
        this.id_polizza = id_polizza;
        this.tipologiaMerce = tipologiaMerce;
        this.stato = stato;
        this.targa = targa;
        this.autotrasportatore = autotrasportatore;
    }

    public int getId() {
        return id;
    }

    public String getCliente() {
        return cliente;
    }

    public int getId_ritirante() {
        return id_ritirante;
    }

    public double getPeso() {
        return peso;
    }

    public int getId_polizza() {
        return id_polizza;
    }

    public String getTipologiaMerce() {
        return tipologiaMerce;
    }

    public String getStato() {
        return stato;
    }

    public String getTarga() {
        return targa;
    }

    public String getAutotrasportatore() {
        return autotrasportatore;
    }
}
