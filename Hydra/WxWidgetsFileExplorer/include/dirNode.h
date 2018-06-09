#ifndef DIRNODE_H
#define DIRNODE_H

#include "wxHeaders.h"
#include "dirRoot.h"
#include "dirContents.h"

class dirRoot;

class dirNode
{
    public:
        dirNode(wxString newFolder);
        ~dirNode();

        wxString getFolder();
        void findContents(wxString fullPath);

        dirContents* getContents();

        friend dirRoot;

    private:
        wxString folder;
        wxString prevPath;

        dirNode* prev;
        dirNode* next;

        dirContents* items;



};

#endif // DIRNODE_H
