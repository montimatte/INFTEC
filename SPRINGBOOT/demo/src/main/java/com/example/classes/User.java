package com.example.classes;

public class User {
    private int id;
    private String username;
    private String password;
    private String ruolo;

    public User(int id, String username, String password, String ruolo) {
        this.id = id;
        this.username = username;
        this.password = password;
        this.ruolo = ruolo;
    }

    public int getId() {
        return id;
    }

    public String getUsername() {
        return username;
    }

    public String getPassword() {
        return password;
    }

    public String getRuolo() {
        return ruolo;
    }
}
