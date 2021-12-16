# Choice Awards
CSC 131 Scrum team project

##
Our website: https://choiceawards.xyz

## Calling The Choice Awards API: 

The format to call it as a query: 
https://choiceawards.xyz/api/api.php/search?variable=value&variable2=value2

    Where the variables for the query can be: movie, nominationCategory, winnerName, awardYear, releaseYear, isWinner, votes
    These can be called in any order, and only desired variables need to be called.

An example of calling our API with query search:
https://choiceawards.xyz/api/api.php/search?awardYear=1997&nominationCategory=best%20picture&isWinner=1

    This will return json formatted data based on the query


The format to call it as not query search: 
https://choiceawards.xyz/api/api.php/title/nominationCategory/winnerName/awardYear/isWinner

    ***IMPORTANT TO NOTE***
    If you want to call in this style, you MUST put 'NA' in every variable spot if you do not wish to get information about it
    You also MUST call it in this order. 
    
        Example: https://choiceawards.xyz/api/api.php/NA/Cinematography/NA/2010/1
        Returns information about the movies that won in the Cinematography category in 2010 in json
