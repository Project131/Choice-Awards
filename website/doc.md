# The Choice Awards CSC 131 project 
# https://github.com/Project131/Choice-Awards                                                  
## The Choice Awards project 

This folder is for all of the web development files used in the creation of this project.
The Server is hosted on a VPS and has the domain https://choiceawards.xyz (yes I set up ssl and a domain name for this project).
There is a mailing service connected to the website. If you create an account you will see an email.

### In the base website folder:

    votingStyle.html is used on the Movie Voting page to allow users to input data and sends a post command to votingUpdate.php (https://choiceawards.xyz/movie-voting).
    votingUpdate.php received a post command from the html code and updates the mySql database to keep track of the votes.
    wpTableResults.php queries mySql and creates a readable array to display the results of the voting (https://choiceawards.xyz/results).

### In the resources folder:

    database.php is the core class that our php calls to connect and query mySql.
    fillDatabase.php is a one time use program that reads in our .json file and fills mySql with our data.
    resetVotes.php is used to reset all of the votes inside of the mySql table. Mostly used for testing and for a final run before setting this project into production.
    the_oscar_award.json is a .json file of oscar award data we got from kaggle



    
