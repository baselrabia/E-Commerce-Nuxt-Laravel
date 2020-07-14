#include <iostream>
#include <stdio.h>
#include <vector>
#include <algorithm>
#include <string>

using namespace std;


int  main() {
  int D;
  cin>>D;
  string word;
  vector<char> words;
  for( int i=0;i<D ; i++){
      cin >> word;
      words.push_back(word[0]);
  }
  for (int m=0;m<words.size();m++)
   {int f[26]={0};
      f[words[m]-'A']++; }  
  int A;
  cin>>A;
  string abb;
  for( int i=0;i<A ; i++){
      cin >> abb;
      for (int j=0;j<D;j++)
      {
      for (int i=0;i<abb.size();i++)
      {
             vector<bool> abbs;

          if (words[j]==abb[i])
           abbs.push_back(1);
          else
           abbs.push_back(0);
      }
      if (abbs.find(0)!=abbs.end())
       cout<<"Oops\n";
       else
       {
          for (int c=0;c<26;c++)
          {
              if (f[c]>1)
              {
                  if (abb.find (char(c+'A')))
                   
              }
          }
       }
      }
     // abbs.push_back(abb);
  }
   /*string status ;

  for( int i=0;i<A ; i++){
      for( int j=0;j< sizeof(abbs[i]); j++){
          if (words[i] == abbs[i][j]){
              continue;
          }else{
                status = "oops";

          }

      }
      if (status != "oops"){
         cout << "PASS" << endl;
      }else{
         cout << status << endl;
      }*/
  }


 return 0;
}