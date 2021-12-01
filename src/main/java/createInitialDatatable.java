/*
    Author: Chris
    This code if for the initial creation of our primary database table. 
    It is made for the purposes of reference to how we initialize the table.
    We hardcoded the username and password for this file. It has been removed for github.
    //Run with: java -cp .:mysql-connector-java-8.0.27.jar createInitialDatatable
*/

import java.sql.*;
import java.io.*;
import java.util.Scanner;
import java.util.Arrays;

class createInitialDatatable {

    private static String dbUrl = "jdbc:mysql://localhost:3306/Movies";
    private static String username = "root";
    private static String password = "MysqlGroup4@";
    private static String fields  = "id int  auto_increment primary key, " +
                                    "title char(200), " +
                                    "nominationCategory char(200), " +
                                    "winnerName varchar(255), " +
                                    "yearReleased int, " +
                                    "awardYear int, " +
                                    "isWinner boolean, " +
                                    "imbdReviewLink char(200), " +
                                    "whereToWatchLink char(200), " +
                                    "votes int";

    public static void main(String ... args) {
        String tableToRead = "movies";

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

    //inserts a test movie into table
    public static void insertTestMovie(String table) {
        String query = "insert into " + table + "(title, nominationCategory, yearReleased, awardYear, isWinner, votes) " + 
                        "values (\"Cool Test Movie\", \"Best Picture\", 2017, 2018, true, 0)";
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
