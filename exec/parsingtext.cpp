#include <iostream>
using std::cout;
using std::endl;
using std::cin;

#include <fstream>
using std::ifstream;

#include <stdlib.h>
#include <cstring>
#include <string>
#include <sstream>
using std::stringstream;
using std::string;

const int MAX_CHARS_PER_LINE = 512;
const int MAX_TOKENS_PER_LINE = 2;
const char*  DELIMITER = ",";
bool checktoken(char* token);
int main(int argc, char * ARGV [])
{
  long int sum = 0;
  stringstream ss,file_path,errorstream;
  ss << "{\"transactions\": [";
  string jsontemp,jsontrans,json,file,error;
  ifstream fin;
  file_path << ARGV[1];
  file = file_path.str();
  fin.open(file.c_str()); // open the file
  if (!fin.good()) 
    return 0; // exit if file not found
  
  // read each line of the file
  while (!fin.eof())
  {
    // read an entire line into memory
    char buf[MAX_CHARS_PER_LINE];
    fin.getline(buf, MAX_CHARS_PER_LINE);
    
	int n = 0; 
    
    // array to store memory addresses of the tokens in buf
    char* token[MAX_TOKENS_PER_LINE] = {}; // initialize to 0
    
    // parse the line
    token[0] = strtok(buf, DELIMITER); // first token
    
    if (token[0]) // zero if line is blank
    {
      if(!checktoken(token[0])){
			cout << "Invalid file";
			return 1;
		}
      for (n = 1; n < MAX_TOKENS_PER_LINE; n++)
      {
        token[n] = strtok(0, DELIMITER); // subsequent tokens
        if(!checktoken(token[n])){
			cout << "Invalid file";
			return 0;
		}
        if (!token[n]) break; // no more tokens
      }
    }
	else
	{
		cout << "Invalid File";
		return 0;
	}
	
	//Construct a Json string 
	//ss << "{\"srcacc\":" << token[0] << ",\"destacc\":" << token[1] << ",\"amount\":" << token[2] << ",\"tan\":\"" << token[3] << "\"}, ";
	ss << "{\"destacc\":" << token[0] << ",\"amount\":" << token[1] << "}, ";
	sum = sum + atol(token[1]);	
  }
 
  jsontemp = ss.str();
  jsontrans = jsontemp.substr(0,jsontemp.length()-2) + "],";    //remove the last character ","
  ss.str(string());  											//free the string stream
  ss << jsontrans << "\"sum\":" << sum << "}";					//include sum of the transaction amount in the json string
  json = ss.str();
  cout << json;
  return 1;
}
bool checktoken(char* token){
	int i=0;
	while(token[i] != '\0'){
		if(!((isdigit(token[i])) || token[i] == '.'))
			return false;
		i++;
	}
	return true;
}

