#include "dirNode.h"

dirNode::dirNode(wxString newFolder){
    folder = newFolder;
    if(newFolder[newFolder.length()-1] != '/' && newFolder != ""){
        folder += "/";
    }
    next = NULL;
    prev = NULL;
}
dirNode::~dirNode(){
    next = NULL;
    prev = NULL;
    delete(items);
}

wxString dirNode::getFolder(){
    return folder;
}

void dirNode::findContents(wxString fullPath){
    items = new dirContents(fullPath);
}

dirContents* dirNode::getContents(){
    return items;
}
