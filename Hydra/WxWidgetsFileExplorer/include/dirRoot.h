#ifndef DIRROOT_H
#define DIRROOT_H

#include "wxHeaders.h"
#include "dirNode.h"
#include "dirContents.h"

class dirNode;

class dirRoot
{
    public:
        dirRoot();
        ~dirRoot();

        wxString pathToString();

        void addNode(wxString newFolder);
        void removeLast();

        dirNode* root;
        dirNode* last;

};

#endif // DIRROOT_H
