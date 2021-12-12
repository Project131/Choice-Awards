# The Choice Awards API documentation 
# https://github.com/Project131/Choice-Awards     

# This documentation file is mostly for developers to keep track of the project

## Calling The Choice Awards API: 

    The format to call it as a query: https://choiceawards.xyz/api/api.php/search?variable=value&variable2=value2

        Where the variables for the query can be: movie, nominationCategory, winnerName, awardYear, releaseYear, isWinner, votes
        These can be called in any order, and only desired variables need to be called.

    An example of calling our API with query search:
        https://choiceawards.xyz/api/api.php/search?awardYear=1997&nominationCategory=best%20picture&isWinner=1

        This will return json formatted data based on the query


    The format to call it as not query search: https://choiceawards.xyz/api/api.php/title/nominationCategory/winnerName/awardYear/isWinner
        ***IMPORTANT TO NOTE***
            If you want to call in this style, you MUST put 'NA' in every variable spot if you do not wish to get information about it

            Example: https://choiceawards.xyz/api/api.php/NA/Cinematography/NA/2010/1



### API Structure:

    api.php is our entry point into the program. The entire api project lives in the api folder.
        https://choiceawards.xyz/api/api.php
    
    createSQL takes in the uri or query values from the api call and creates a MySql query string

    Inside the resources folder is the database.php file. This is the heart of the api. 
    It connects to our data base, and has multiple useful functions which can be called within the api.

    Inside the tests folder there are two test files.
        testApi.php creates multiple sample url calls and compares our api calls result to a known value
        testDB.php tests all of the functions in the database.php file to ensure it is working correctly

    wpTableResults.php is mostly used for the front end tables. It can be used to view a 2-D array of all the data with votes however.