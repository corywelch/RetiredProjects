#include "dirRoot.h"

dirRoot::dirRoot()
{
    root = new dirNode("");
    last = root;
    last->findContents("");
}

dirRoot::~dirRoot()
{
    dirNode* temp = last;
    last = NULL;
    root = NULL;
    while(temp->prev != NULL){
        dirNode* temp = last;
        last = last->prev;
        last->next = NULL;
        temp->prev = NULL;
        delete temp;
    }

    delete temp;
}

void dirRoot::addNode(wxString newFolder){

    dirNode* temp = new dirNode(newFolder);
    temp->prev = last;
    last->next = temp;
    last = temp;
    last->findContents(pathToString());

}

void dirRoot::removeLast(){
    if(last != root){
        dirNode* temp = last;
        last = last->prev;
        last->next = NULL;
        temp->prev = NULL;
        delete temp;
    }
}

wxString dirRoot::pathToString(){
    dirNode* temp = root;
    wxString fullPath = root->getFolder();
    while(temp->next != NULL){
        temp = temp->next;
        fullPath += temp->getFolder();
    }
    return fullPath;
}
