#include "mainwindow.h"

#include <QToolBar>
#include <QStatusBar>
#include <QAction>
#include <QLabel>
#include <QListWidget>

MainWindow::MainWindow(QWidget *parent) :
    QMainWindow(parent), view(new QListView), model(new QFileSystemModel)
{
    QToolBar* leftToolBar = addToolBar(tr("LeftSide"));
    QAction* menuAct = new QAction(QIcon(tr(":/menu.png")), tr("Menu"), this);
    leftToolBar->addAction(menuAct);
    QAction* userAct = new QAction(QIcon(tr(":/user.png")), tr("Menu"), this);
    leftToolBar->addAction(userAct);

    QToolBar* rightToolBar = addToolBar(tr("RightSide"));
    QAction* viewAct = new QAction(QIcon(tr(":/view.png")), tr("Menu"), this);
    rightToolBar->addAction(viewAct);
    QAction* filterAct = new QAction(QIcon(tr(":/filter.png")), tr("Menu"), this);
    rightToolBar->addAction(filterAct);
    QAction* searchAct = new QAction(QIcon(tr(":/search.png")), tr("Menu"), this);
    rightToolBar->addAction(searchAct);
    QAction* settingsAct = new QAction(QIcon(tr(":/settings.png")), tr("Menu"), this);
    rightToolBar->addAction(settingsAct);

    statusBar()->addWidget(new QLabel(tr("File Explorer Mode")));

//    view->AddItem("Item1");
//    view->AddItem("Item2");
//    view->AddItem("Item3");

    model->setRootPath(tr("%homedir%"));
    model->setFilter(QDir::AllDirs | QDir::NoDotAndDotDot);
    view->setModel(model);

    setCentralWidget(view);
    setGeometry(50, 50, 800, 600);
}

MainWindow::~MainWindow()
{
}
