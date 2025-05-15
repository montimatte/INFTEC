package com.example.classes;

public class Registro {
    private int idBuono;
    private String cliente;
    private String targa;
    private String autotrasportatore;
    private double peso;
    private int id_polizza;
    private String tipologiaMerce;
    private String dataOraRitiro;

    public Registro(int idBuono, String cliente, double peso, int id_polizza, String tipologiaMerce, String targa, String autotrasportatore, String dataOraRitiro) {
        this.idBuono = idBuono;
        this.cliente = cliente;
        this.peso = peso;
        this.id_polizza = id_polizza;
        this.tipologiaMerce = tipologiaMerce;
        this.targa = targa;
        this.autotrasportatore = autotrasportatore;
        this.dataOraRitiro = dataOraRitiro;
    }

    public int getIdBuono() {
        return idBuono;
    }

    public String getCliente() {
        return cliente;
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

    public String getTarga() {
        return targa;
    }

    public String getAutotrasportatore() {
        return autotrasportatore;
    }

    public String getDataOraRitiro() {
        return dataOraRitiro;
    }
}
