/*
    This code if for the initial creation of our primary database table. It is not for use in other code.
*/

import java.sql.*;
import java.io.*;
import java.util.Scanner;
import java.util.Arrays;

class createInitialDatatable {

    private static String dbUrl = "jdbc:mysql://localhost:3306/movies";
    private static String username = "root";
    private static String password = "MysqlGroup4@";
    private static String fields = "id int  auto_increment primary key, title char(200), category char(200)";

    public static void main(String ... args) {
        String tableToRead = "movies";
        String movieName = "Lord of the Rings";
        String category = "Fantasy Adventure";

        createTable(tableToRead, fields);
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
}