import java.sql.*;

class sqlTest {
    public static void main(String ... args) {
        try {
            String dbUrl = "jdbc:mysql://localhost:3306/Awards";
            String username = "root";
            String password = "MysqlGroup4@";
            Connection myConnection = DriverManager.getConnection(dbUrl, username, password);
            
            Statement myStatement = myConnection.createStatement();
            ResultSet myResultSet = myStatement.executeQuery("Select * from Awards");

            while(myResultSet.next()) {
                //System.out.println("Student full name: " + myResultSet.getString("firstname") + " " + myResultSet.getString("lastname"));
            }
        }

        catch(Exception e) {
            System.out.println(e.getMessage());
        }
    }
}