/*
Author: Chris Lemke
Call class like SqlDatabase(dataBaseName, username, password)
*/

import java.sql.*;
public class SqlDatabase {

    private static String dbName; 
    private static String dbUrl;
    private static String username; 
    private static String password;
    //private static String fields = "id int  auto_increment primary key, title char(200), category char(200)"; //used for a template to create a new table

    //constructor for class sets all of the needed information to connect
    public static void SqlDatabase(String dataBase, String userName, String passWord) {
        dbName = dataBase;
        username = userName;
        password = passWord;
        dbUrl = "jdbc:mysql://localhost:3306/" + dbName;
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