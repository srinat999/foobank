#include <iostream>
using std::cout;
using std::endl;

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
char* const DELIMITER = ",";

int main(int argc, char * ARGV [])
{
  long int sum = 0;
  stringstream ss,file_path;
  ss << "[";
  string jsontemp,json,file;
  ifstream fin;
  file_path << "/home/samurai/Desktop/⁄var⁄www/ScTeam11/" << ARGV[1];
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
      for (n = 1; n < MAX_TOKENS_PER_LINE; n++)
      {
        token[n] = strtok(0, DELIMITER); // subsequent tokens
        if (!token[n]) break; // no more tokens
      }
    }

    // process (print) the tokens
 /*   for (int i = 0; i < n; i++) // n = #of tokens
      cout << "Token[" << i << "] = " << token[i] << endl;
    cout << endl; */

	//Construct a Json string 
	//ss << "{\"srcacc\":" << token[0] << ",\"destacc\":" << token[1] << ",\"amount\":" << token[2] << ",\"tan\":\"" << token[3] << "\"}, ";
	ss << "{\"destacc\":" << token[0] << ",\"amount\":" << token[1] << "}, ";
	sum = sum + atol(token[1]);
	
  }
  ss << "{\"sum\":" << sum << "}";
  jsontemp = ss.str();
  //json = jsontemp.substr(0,jsontemp.length()-2) + "]";   //remove the last character ","
  json = jsontemp + "]";
  cout << json;
  return 1;
}


