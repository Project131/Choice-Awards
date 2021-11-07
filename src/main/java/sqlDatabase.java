import java.sql.*;

class sqlDatabase {

    private static String dbUrl = "jdbc:mysql://localhost:3306/test";
    private static String username = "test";
    private static String password = "test";

    public static void main(String ... args) {
        String fields = "id int  auto_increment primary key, title char(200), category char(200)";
        String tableToRead = "movies";
        String movieName = "Lord of the Rings";
        String category = "Fantasy Adventure";

        createTable(tableToRead, fields);
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
            ResultSet myResultSet = myStatement.executeQuery(query);
            System.out.println("ran command: " + query);

        }
        catch(Exception e) {
            System.out.println(e.getMessage());
        }
    }
}