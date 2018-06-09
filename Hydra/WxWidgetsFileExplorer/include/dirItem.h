#ifndef DIRITEM_H
#define DIRITEM_H

#include "wxHeaders.h"

class dirItem
{
    public:
        dirItem();
        dirItem(wxString Name, wxString Type);
        ~dirItem();

        unsigned int index;

        wxString name;
        wxString type;

        dirItem* next;
        dirItem* prev;
};

#endif // DIRITEM_H
