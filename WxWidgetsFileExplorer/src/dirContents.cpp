#include "dirContents.h"

dirContents::dirContents(){
    len = 0;
    first = NULL;
    last = NULL;
    path = "";
}

dirContents::dirContents(wxString fullPath){
    len = 0;
    first = NULL;
    last = NULL;

    /*wxArrayString files;
    wxDir::GetAllFiles(navPath->pathToString(),&files,wxEmptyString,wxDIR_FILES|wxDIR_DIRS);
    for(unsigned int i = 0; i < files.GetCount(); i++){
        listContent->InsertItem((1000+i),files[i]);}*/

    path = fullPath;
    if(path != ""){
        //Not root directory
        wxString itemName;
        bool cont = true;
        wxDir workingDir;{
            wxLogNull logNull;
            if(!workingDir.Open(path)){
                //Open Failed
                cont = false;
                return;
            }
            if(!workingDir.GetFirst(&itemName,wxEmptyString,wxDIR_FILES|wxDIR_DIRS)){
                //GetFirstFailed
                cont = false;
            }
        };

        for(int i = 0; cont; i++){
            wxString typeStr = "";
            if(wxDir::Exists(fullPath+itemName)){
                typeStr = "Folder";
            } else {
                typeStr = "File";
            }
            addItem(itemName,typeStr);

            cont = workingDir.GetNext(&itemName);
        }
    } else {
        //Drive Letter/Volume determination
        wxString osName = wxPlatformInfo::Get().GetOperatingSystemFamilyName();
        if(osName == "Windows"){
            wxString letters [26] = {"A:/","B:/","C:/","D:/","E:/","F:/","G:/","H:/","I:/","J:/","K:/","L:/","M:/","N:/","O:/","P:/","Q:/","R:/","S:/","T:/","U:/","V:/","W:/","X:/","Y:/","Z:/"};
            for(int i = 0; i <26; i++){
                if(wxDir::Exists(letters[i])){
                    addItem(letters[i],"Drive");
                }
            }
        } else {

        }
    }

}

dirContents::~dirContents()
{
    dirItem* temp = last;
    while(temp->prev != NULL){
        temp = temp->prev;
        delete(temp->next);
    }
    last = NULL;
    first = NULL;
    delete(temp);
}

bool dirContents::isEmpty(){
    return len==0?true:false;
}

void dirContents::addItem(wxString Name, wxString Type){
    dirItem* temp = new dirItem(Name,Type);
    temp->index = len;
    len++;
    if(len==1){
        first = temp;
        last = temp;
    } else {
        last->next = temp;
        temp->prev = last;
        last = temp;
    }
}

dirItem* dirContents::selected(unsigned int index){
    dirItem* temp = first;
    if(index < len){
        while(temp->index != index){
            temp = temp->next;
        }
    } else {
        temp = last;
    }
    return temp;
}
