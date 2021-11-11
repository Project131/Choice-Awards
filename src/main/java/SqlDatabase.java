/*
Author: Chris Lemke
Call constructor for the class with the name of the database you wish to connect to
*/

import java.sql.*;
import java.io.*;
import java.util.Scanner;


public class SqlDatabase {

    private static String dbName; 
    private static String dbUrl;
    private static String username; 
    private static String password;
    private static String fields = "id int  auto_increment primary key, title char(200), category char(200)"; //used for a template to create a new table


    //when implementing, this main function will represent the class this file is called from
    public static void main(String ... args) {
        String dataBaseName = "Movies";
        String tableToRead = "movies";
        String movieName = "Lord of the Rings";
        String category = "Fantasy Adventure";

        SqlDatabase(dataBaseName); //this will act as the constructor when main is split into production code

        //createTable(tableToRead, fields);
        readTable(tableToRead);
        System.out.println("\n");
    
        insertMovie(tableToRead, movieName, category);
        readTable(tableToRead);
        System.out.println("\n");
    
        movieName = "The Hobbit: An Unexpected Journey";
    
        insertMovie(tableToRead, movieName, category);
        readTable(tableToRead);
        System.out.println("\n");
    
        deleteMovie(tableToRead, movieName);
        readTable(tableToRead);
        System.out.println("\n");
    
        //customQuery("select * from movies");
    }

    public static void SqlDatabase(String dataBase) {
        dbName = dataBase;
        dbUrl = "jdbc:mysql://localhost:3306/" + dbName;
        setLoginInfo();
    }

    //get the login info from the server
    private static void setLoginInfo() {
        int i = 0;
        String[] information = new String[3];
        try {
            File file = new File("database.txt");
            Scanner myReader = new Scanner(file);
            while(myReader.hasNextLine()) {
                String data = myReader.nextLine();
                information[i] = data;
                i++;
            }
            username = information[0];
            password = information[1];
            myReader.close();
        }
        catch (FileNotFoundException e) {
            System.out.println("An error has occured.");
            e.printStackTrace();
        }
    }

    //reads the entire table
    public static void readTable(String table) {
        String query = "select * from " + table;
        try {
            Connection myConnection = DriverManager.getConnection(dbUrl, username, password);
            Statement myStatement = myConnection.createStatement();
            ResultSet myResultSet = myStatement.executeQuery(query);

            while(myResultSet.next()) {
                System.out.println("Movie id: " + myResultSet.getString("id") + "\tMovie Title: " + 
                                    myResultSet.getString("title") + "\t\tCategory: " + myResultSet.getString("category"));
            }
        }
        catch(Exception e) {
            System.out.println(e.getMessage());
        }
    }

    //inserts a movie title into table
    public static void insertMovie(String table, String movieName, String category) {
        String query = "insert into " + table + "(title, category) values(\""+movieName+"\",\""+category+"\");";
        try {
            Connection myConnection = DriverManager.getConnection(dbUrl, username, password);
            Statement myStatement = myConnection.createStatement();
            myStatement.executeUpdate(query);
        }
        catch(Exception e) {
            System.out.println(e.getMessage());
        }
    }

    //deletes a movie title into movies table
    public static void deleteMovie(String table, String movieName) {
        String query = "delete from " + table + " where title = \""+movieName+"\";";
        try {
            Connection myConnection = DriverManager.getConnection(dbUrl, username, password);
            Statement myStatement = myConnection.createStatement();
            myStatement.executeUpdate(query);
        }
        catch(Exception e) {
            System.out.println(e.getMessage());
        }
    }

    //This functions creates a table in the sql database
    public static void createTable(String table, String fields) {
        String query = "create table " + table + "(" + fields + ");";
        System.out.println(query);
        try {
            Connection myConnection = DriverManager.getConnection(dbUrl, username, password);
            Statement myStatement = myConnection.createStatement();
            myStatement.executeUpdate(query);
        }
        catch(Exception e) {
            System.out.println(e.getMessage());
        }
    }

    //This function allows a user to pass a custom query string into mysql
    public static void customQuery(String query) {
        try {
            Connection myConnection = DriverManager.getConnection(dbUrl, username, password);
            Statement myStatement = myConnection.createStatement();
            myStatement.executeQuery(query);
            System.out.println("ran command: " + query);

        }
        catch(Exception e) {
            System.out.println(e.getMessage());
        }
    }
}