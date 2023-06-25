import pymysql

# Establish a connection to the database
conn = pymysql.connect(
    host="127.0.0.1",
    user="root",
    password="",
    database="gestiondebibliotheque",
    port=3306
)

# Create a cursor object to interact with the database
cursor = conn.cursor()

# Execute a SELECT query to retrieve data from a table
cursor.execute("SELECT * FROM livres")

# Fetch all the rows returned by the query
rows = cursor.fetchall()

# Iterate over the rows and print the data
for row in rows:
    titre = row[0]
    auteur = row[1]
    annee = row[2]
    categorie = row[3]
    print("titre: ", titre)
    print("auteur: ", auteur)
    print("annee: ", annee)
    print("categorie: ", categorie)
    print()

# Close the cursor and the database connection
cursor.close()
conn.close()
