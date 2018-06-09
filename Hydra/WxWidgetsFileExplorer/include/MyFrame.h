#ifndef MYFRAME_H
#define MYFRAME_H

#include "wxHeaders.h"
#include "dirRoot.h"
#include "dirContents.h"

class MyFrame : public wxFrame
{
    public:
        MyFrame(const wxString& title);
        void updateList();
    private:

        wxPanel* mainPanel;
        wxBoxSizer* mainSizer;

        wxBoxSizer* toolsSizer;

        wxButton* homeButton;
        wxButton* upButton;
        wxButton* showExplorerButton;

        wxBoxSizer* bodySizer;

        wxListCtrl* navTree;
        wxListCtrl* listContent;

        dirRoot* navPath;

        void homePressed(wxCommandEvent& event);
        void upPressed(wxCommandEvent& event);
        void showExplorerPressed(wxCommandEvent& event);
        void folderSelected(wxListEvent& event);

        void OnExit(wxCommandEvent& event);

        static const long ID_file_quit;
        static const long ID_help_about;

        static const long ID_homeButton;
        static const long ID_upButton;
        static const long ID_showExplorerButton;

        static const long ID_listContent;

        bool fileExplorerOpen;

        //Done Dynamically instead
        //wxDECLARE_EVENT_TABLE();

};

#endif // MYFRAME_H
