#include "dirItem.h"

dirItem::dirItem()
{
    next = NULL;
    prev = NULL;
    name = "";
    type = "";
}
dirItem::dirItem(wxString Name, wxString Type)
{
    next = NULL;
    prev = NULL;
    name = Name;
    type = Type;
}

dirItem::~dirItem()
{
    next = NULL;
    prev = NULL;
}

