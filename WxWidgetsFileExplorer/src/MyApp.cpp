#include "MyApp.h"

IMPLEMENT_APP(MyApp);

bool MyApp::OnInit(){
    bool wxStatus = true;
    if(wxStatus){
        MyFrame* mainFrame = new MyFrame(_T("MeCloud"));
        mainFrame->Show();
        SetTopWindow(mainFrame);
    }
    return wxStatus;
}
