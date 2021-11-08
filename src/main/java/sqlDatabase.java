import java.sql.*;
import java.io.*;
import java.util.Scanner;
import java.util.Arrays;
class sqlDatabase {

    private static String dbName;
    private static String dbUrl;
    private static String username;
    private static String password;
    private static String fields = "id int  auto_increment primary key, title char(200), category char(200)";

    public static void main(String ... args) {
        String tableToRead = "movies";
        String movieName = "Lord of the Rings";
        String category = "Fantasy Adventure";

        setLoginInfo();

        //createTable(tableToRead, fields);
        readTable(tableToRead);
        System.out.println("\n");

        insertMovie(movieName, category);
        readTable(tableToRead);
        System.out.println("\n");

        movieName = "The Hobbit: An Unexpected Journey";

        insertMovie(movieName, category);
        readTable(tableToRead);
        System.out.println("\n");

        deleteMovie(movieName);
        readTable(tableToRead);
        System.out.println("\n");

        //customQuery("select * from movies");
    }

    //get the login info from the server
    public static void setLoginInfo() {
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
            dbName = information[0];
            username = information[1];
            password = information[2];
            dbUrl = "jdbc:mysql://localhost:3306/" + dbName;
            myReader.close();
        }
        catch (FileNotFoundException e) {
            System.out.println("An error has occured.");
            e.printStackTrace();
        }
    }

    //reads the entire table of movie names
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

    //inserts a movie title into movies table
    public static void insertMovie(String movieName, String category) {
        String query = "insert into movies(title, category) values(\""+movieName+"\",\""+category+"\");";
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
    public static void deleteMovie(String movieName) {
        String query = "delete from movies where title = \""+movieName+"\";";
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