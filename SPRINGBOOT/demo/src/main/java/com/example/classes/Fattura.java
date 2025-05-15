package com.example.classes;

public class Fattura {
    private int id;
    private double importo;
    private int idBuono;
    private String merce;
    private double peso;

    public Fattura(int id, double importo, int idBuono, String merce, double peso) {
        this.id = id;
        this.importo = importo;
        this.idBuono = idBuono;
        this.merce = merce;
        this.peso = peso;
    }

    public int getId() {
        return id;
    }

    public double getImporto() {
        return importo;
    }

    public int getIdBuono() {
        return idBuono;
    }

    public String getMerce() {
        return merce;
    }

    public double getPeso() {
        return peso;
    }
}
