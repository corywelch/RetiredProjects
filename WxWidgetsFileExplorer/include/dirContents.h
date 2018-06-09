#ifndef DIRCONTENTS_H
#define DIRCONTENTS_H

#include "wxHeaders.h"
#include "dirItem.h"

class dirContents
{
    public:
        dirContents();
        dirContents(wxString fullPath);
        ~dirContents();

        unsigned int len;

        void addItem(wxString Name, wxString Type);

        dirItem* selected(unsigned int index);

        bool isEmpty();

    private:
        dirItem* first;
        dirItem* last;
        wxString path;

};

#endif // DIRCONTENTS_H
