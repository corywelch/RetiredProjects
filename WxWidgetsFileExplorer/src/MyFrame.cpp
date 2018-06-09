#include "MyFrame.h"

//Id Definitions
// Menus <100
//Button 100<200
//List Row IDs 10000<20000

const long MyFrame::ID_file_quit = 10;
const long MyFrame::ID_help_about = 20;
const long MyFrame::ID_homeButton = 100;
const long MyFrame::ID_upButton = 101;
const long MyFrame::ID_showExplorerButton = 102;
const long MyFrame::ID_listContent = 501;

//Done Dynamically Below instead
/*wxBEGIN_EVENT_TABLE(MyFrame, wxFrame)
    EVT_MENU(ID_file_quit, MyFrame::OnExit)
    EVT_BUTTON(ID_homeButton, MyFrame::homePressed)
    EVT_BUTTON(ID_upButton, MyFrame::upPressed)
wxEND_EVENT_TABLE()*/

MyFrame::MyFrame(const wxString& title)
{
    //this actually creates the frame with following properties
    Create(NULL, -1, title, wxPoint(100,50),wxSize(1200,850));
    SetMinSize(wxSize(600,425));
    //menu bar
    wxMenuBar* menuBar = new wxMenuBar();
    //file menu option
    wxMenu* fileMenu = new wxMenu();
    //add quit option to file menu
    fileMenu->Append(ID_file_quit, _("&Quit\tAlt-F4"), _("Quit the application"));
    //add file menu to menu bar
    menuBar->Append(fileMenu, _("&File"));
    Connect(ID_file_quit,wxEVT_COMMAND_MENU_SELECTED,wxCommandEventHandler(MyFrame::OnExit));

    //same as above only for help and about option
    wxMenu* helpMenu = new wxMenu();
    helpMenu->Append(ID_help_about, _("&About\tF1"), _("Show blah about this application"));
    menuBar->Append(helpMenu, _("&Help"));

    //Sets the menu bar for the given frame
    SetMenuBar(menuBar);

    //Create internal panel
    mainPanel = new wxPanel(this,100,wxDefaultPosition,wxDefaultSize,wxTAB_TRAVERSAL);

    mainSizer = new wxBoxSizer(wxVERTICAL);

    toolsSizer = new wxBoxSizer(wxHORIZONTAL);
    bodySizer = new wxBoxSizer(wxHORIZONTAL);

    fileExplorerOpen = true;

    homeButton = new wxButton(mainPanel,ID_homeButton,_T("Home"),wxDefaultPosition,wxSize(50,50),0,wxDefaultValidator,_T("ID_homeButton"));
    toolsSizer->Add(homeButton,1,wxALL, 3);
    Connect(ID_homeButton,wxEVT_BUTTON,wxCommandEventHandler(MyFrame::homePressed));

    upButton = new wxButton(mainPanel,ID_upButton,_T("Up"),wxDefaultPosition,wxSize(50,50),0,wxDefaultValidator,_T("ID_upButton"));
    toolsSizer->Add(upButton,1,wxALL, 3);
    Connect(ID_upButton,wxEVT_BUTTON,wxCommandEventHandler(MyFrame::upPressed));

    showExplorerButton = new wxButton(mainPanel,ID_showExplorerButton,_T("Show"),wxDefaultPosition,wxSize(50,50),0,wxDefaultValidator,_T("ID_showExplorerButton"));
    toolsSizer->Add(showExplorerButton,1,wxALL, 3);
    Connect(ID_showExplorerButton,wxEVT_BUTTON,wxCommandEventHandler(MyFrame::showExplorerPressed));

    navTree = new wxListCtrl(mainPanel,500);
    listContent = new wxListCtrl(mainPanel,ID_listContent,wxDefaultPosition,wxDefaultSize,wxLC_REPORT);
    bodySizer->Add(navTree,2,wxALL|wxEXPAND,0);
    bodySizer->Add(listContent,5,wxALL|wxEXPAND,0);

    mainSizer->Add(toolsSizer,0, wxALL, 2);
    mainSizer->Add(bodySizer,1,wxALL|wxEXPAND,5);

    //add sizer to panel
    mainPanel->SetSizer(mainSizer);
    //make sizer fit to the main panel
    mainSizer->Fit(mainPanel);

    listContent->InsertColumn(700,"Name",wxLIST_FORMAT_LEFT,300);
    listContent->InsertColumn(701,"Type",wxLIST_FORMAT_LEFT,100);

    navPath = new dirRoot();
    navPath->addNode("C:/");
    updateList();

}

void MyFrame::folderSelected(wxListEvent& event){
    dirItem* item = navPath->last->getContents()->selected(event.GetIndex());
    if(item->type == "Folder" || item->type == "Drive"){
        navPath->addNode(item->name);
        updateList();
    }

}

void MyFrame::updateList(){
    listContent->DeleteAllItems();
    dirContents* rootList = navPath->last->getContents();
    for(unsigned int i = 0; i < rootList->len; i++){
        long itemIndex = listContent->InsertItem(10000+i,rootList->selected(i)->name);
        listContent->SetItem(itemIndex,1,rootList->selected(i)->type);
        Connect(ID_listContent,wxEVT_LIST_ITEM_ACTIVATED,wxListEventHandler(MyFrame::folderSelected));
    }
}

void MyFrame::upPressed(wxCommandEvent& event){
    navPath->removeLast();
    updateList();
}

void MyFrame::homePressed(wxCommandEvent& event){
    while(navPath->root != navPath->last){
        navPath->removeLast();
    }
    updateList();
}

void MyFrame::showExplorerPressed(wxCommandEvent& event){
    bodySizer->Show(mainPanel,!fileExplorerOpen,true);
    fileExplorerOpen = !fileExplorerOpen;
    bodySizer->Layout();
}

void MyFrame::OnExit(wxCommandEvent& event)
{
    Close(true);
}


