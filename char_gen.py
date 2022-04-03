import requests
import random
import ast
import sys
import argparse

dnd_url = "https://www.dnd5eapi.co/api/"

# To get requests from the API, call a GET request.
# response = requests.request("GET", dnd_url)

def get_mod(stat):
	if stat == 1:
		return -5
	elif stat == 2 or stat == 3:
		return -4
	elif stat == 4 or stat == 5:
		return -3
	elif stat == 6 or stat == 7:
		return -2
	elif stat == 8 or stat == 9:
		return -1
	elif stat == 10 or stat == 11:
		return 0
	elif stat == 12 or stat == 13:
		return 1
	elif stat == 14 or stat == 15:
		return 2
	elif stat == 16 or stat == 17:
		return 3
	elif stat == 18 or stat == 19:
		return 4
	elif stat == 20:
		return 5		
class_list = ['Barbarian','Bard','Cleric','Druid','Fighter','Monk','Paladin','Ranger','Rogue','Socerer','Warlock','Wizard']
random_choice_class = random.choice(class_list)

race_list = ['Dragonborn','Dwarf','Elf','Gnome','Half-Elf','Half-Orc','Halfling','Human','Tiefling']
random_choice_race = random.choice(race_list)

alignment_list = ['Chaotic-Evil','Chaotic-Good','Chaotic-Neutral','Lawful-Evil','Lawful-Good','Lawful-Neutral','Neutral','Neutral-Good','Neutral-Evil']
random_choice_alignment = random.choice(alignment_list)

# Gathering commandline arguments to pass into the script
parser = argparse.ArgumentParser(description="5e Character generator to a dictionary.", formatter_class=argparse.ArgumentDefaultsHelpFormatter)

parser.add_argument("name", help="The user's account name")
parser.add_argument("char_name", help="The character's name")
parser.add_argument("-c", "--the_class", default=str(random_choice_class), help="The class")
parser.add_argument("-r", "--race", default=str(random_choice_race),help="The race")
parser.add_argument("-l", "--level", default=random.randint(1,10), help="The level", type=int)
parser.add_argument("-a", "--alignment", default=str(random_choice_alignment),help="The alignment")
args = parser.parse_args()
config = vars(args)

name = args.name
char_name = args.char_name
their_class = args.the_class
race = args.race
level = args.level
alignment = args.alignment




if name == None:
	sys.exit("need name arg!")

if char_name == None:
	sys.exit("Need char_name arg!")

print("ARGS USED:")
print(config)




# Start of script
print ("Welcome to the Test Character Generator.")
print ("This will generate a test character in a dictionary, seperated by keys.")
print ("There are a few required variables to generate a character.")
print ("Pass them as commandline arguements. The order MUST BE Name, Character Name, Class, Race, Level, Alignment.")


STR = random.randint(2,20)
DEX = random.randint(2,20)
CON = random.randint(2,20)
INT = random.randint(2,20)
WIS = random.randint(2,20)
CHA = random.randint(2,20)

STR_MOD = get_mod(STR)
DEX_MOD = get_mod(DEX)
CON_MOD = get_mod(CON)
INT_MOD = get_mod(INT)
WIS_MOD = get_mod(WIS)
CHA_MOD = get_mod(CHA)

#Generates HP based on level, and their con_mod
HP = ((level+1)*random.randint(1,8))+CON_MOD

# This request gets all their information about their class
their_class_response = requests.request("GET", "https://www.dnd5eapi.co/api/classes/"+str(their_class.lower()))
their_race_response = requests.request("GET", "https://www.dnd5eapi.co/api/races/"+str(race.lower()))

#This converts the byte object into a dictionary
their_class_data = ast.literal_eval((their_class_response.content).decode("UTF-8"))
their_race_data = ast.literal_eval((their_race_response.content).decode("UTF-8"))

# Grabs the hitdice from this new dictionary
hit_dice = their_class_data.get("hit_die")

# Ability mods based on race
ability_bonus = their_race_data.get("ability_bonuses")

for i in ability_bonus:
	bonus_num = i['bonus']
	race_bonus_name = i['ability_score']
	if name == "STR":
		STR_MOD = STR_MOD + bonus_num
	elif name == "DEX":
		DEX_MOD = DEX_MOD + bonus_num
	elif name == "CON":
		CON_MOD = CON_MOD + bonus_num
	elif name == "DEX":
		INT_MOD = INT_MOD + bonus_num
	elif name == "WIS":
		WIS_MOD = WIS_MOD + bonus_num
	elif name == "CHA":
		CHA_MOD = CHA_MOD + bonus_num

# Armor class 

AC = DEX_MOD + 10	

# Flavor text additions to character - kind of bulky but worth storing

size_description = their_race_data.get("size_description")
languages_desc = their_race_data.get("language_desc")
traits = their_race_data.get("traits")




character_dictionary = { 
"Name" : name,
"Character_Name" : char_name,
"Class" : their_class,
"Race" : race,
"Level" : level,
"Alignment" : alignment,
"STR" : STR,
"DEX" : DEX,
"CON" : CON,
"INT" : INT,
"WIS" : WIS,
"CHA" : CHA,
"STR_MOD" : STR_MOD,
"DEX_MOD" : DEX_MOD,
"CON_MOD" : CON_MOD,
"INT_MOD" : INT_MOD,
"WIS_MOD" : WIS_MOD,
"CHA_MOD" : CHA_MOD,
"HP" : HP,
"Hit_Dice" : hit_dice,
"AC" : AC,
"Size_desc" : size_description,
"Lang_desc" : languages_desc,
"Traits" : traits

}

# Right now all number stats are picked for you.
the_file = open("the_char.txt", "w")
for i in character_dictionary:
  first = i
  second = character_dictionary[i]
  final = str(first)+str(second)
  print(str(first)+str(second))
  the_file.write(final)
the_file.close()
