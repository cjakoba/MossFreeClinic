# Requires mysql.connector to run
# pip install mysql-connector-python

import mysql.connector

config = {
        'user': 'homebasedb',
        'password': 'homebasedb',
        'host': 'localhost',
        'database': 'homebasedb'
}

conn = mysql.connector.connect(**config)
cursor = conn.cursor()

file = input("SQL file to run: ")

try:
    with open('../' + file, 'r') as file:
        sql_script = file.read()
        for statement in sql_script.split(';'):
            if statement.strip():
                cursor.execute(statement)
except IOError as e:
    print(f"Failed to open file ({e})")

cursor.close()
conn.close()

print("Script completed.")
