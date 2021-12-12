# The Choice Awards website documents folder 
# https://github.com/Project131/Choice-Awards                                                  
## The Choice Awards website folder 

    This folder is for all of the web development files used in the creation of this project.
    The Server is hosted on a VPS and has the domain https://choiceawards.xyz (yes I set up ssl and a domain name for this project).
    There is a mailing service connected to the website. If you create an account you will see an email.

### In the base website folder:

    The api project folder.
        Filled with PHP code that runs our public api which returns information about oscar winnings and nominations.
            - resources folder.
                - database.php: A PHP file for connecting to our MySql database and some functions for querying it.
            - tests folder.
                -testApi.php: A PHP file for testing API calls to our own API
                -testDB.php: A php file for testing our DB connection file and some of the functions in it.
            -api.php: A PHP file which acts as the entry point to our api. Reads in API query and returns the json formatted data.
            -createSQL.php: A PHP file which takes the API query data and creates a MySql query. Decides what to api returns.
            -wpTableResults.php: Queries out DB data for votes and creates 2-D array of data. Useful for seeing all the votes and used on front end displays.

    The util folder. 
        Filled with PHP files used for connections to the website front end, team logos, and a .json file of initial DB data 
            - choice-awards-logo-dark.png: A Dark theme logo for our team 
            - choice-awards-logo-dark.png: A light theme logo for our team
            - createTable.php: PHP code to create a table in a DB
            - fillDatabase.php: PHP code to fill the DB table with information from the .json file
            - resetVotes.php: PHP code to reset the votes in our database. 
            - the_oscar_award.json: A .json file of oscar award data we got from kaggle
            - votingStyle.html: An .html file used on our front end website on the 'Movie Voting' page. Sends inputed data via POST to votingUpdate.php
            - votingUpdate.php: PHP code that receives the voting data from the front end via POST

    A doc.md file which is this same file

### In the doc folder:

    CSC 131 Style Guide.pdf: A style guide for how to format our code. Origionally made for java, but continued use for PHP.
    Group4APIdiagram.JPG: A diagram of how our API code connects and flows.
    Obstacles_Approaches.pdf: The challenges we faced as a group during this assignment.
    sampleHeader.txt: A sample text of the header we used at the top of our files.
    websiteDoc.md: A doc folder explaining everything in website folder. (This file!)
