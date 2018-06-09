#include "mainwindow.h"

#include <QMenuBar>
#include <QToolBar>
#include <QStatusBar>
#include <QAction>
#include <QLabel>
#include <QListWidget>
#include <QHeaderView>
#include <QApplication>
#include <QMessageBox>

MainWindow::MainWindow(QWidget *parent) :
    QMainWindow(parent), view(new QTreeView), model(new QFileSystemModel)
{
    setWindowIcon(QIcon(tr(":/logo.pmg)")));

    QMenu *fileMenu = menuBar()->addMenu(tr("&File"));
    const QIcon exitIcon = QIcon::fromTheme("application-exit");
    QAction *exitAct = new QAction(exitIcon, tr("E&xit"), this);
    exitAct->setShortcuts(QKeySequence::Quit);
    exitAct->setStatusTip(tr("Exit the application"));
    connect(exitAct, &QAction::triggered, this, &QWidget::close);
    fileMenu->addAction(exitAct);

    menuBar()->addSeparator();

    QMenu *helpMenu = menuBar()->addMenu(tr("&Help"));

    QAction *aboutAct = helpMenu->addAction(tr("&About"), this, &MainWindow::about);
    aboutAct->setStatusTip(tr("Show the application's About box"));

    QAction *aboutQtAct = helpMenu->addAction(tr("About &Qt"), qApp, &QApplication::aboutQt);
    aboutQtAct->setStatusTip(tr("Show the Qt library's About box"));

    QToolBar* leftToolBar = addToolBar(tr("LeftSide"));
    QAction* menuAct = new QAction(QIcon(tr(":/menu.png")), tr("Menu"), this);
    leftToolBar->addAction(menuAct);
    QAction* userAct = new QAction(QIcon(tr(":/user.png")), tr("User"), this);
    leftToolBar->addAction(userAct);

    QToolBar* rightToolBar = addToolBar(tr("RightSide"));
    QAction* viewAct = new QAction(QIcon(tr(":/view.png")), tr("View"), this);
    rightToolBar->addAction(viewAct);
    QAction* filterAct = new QAction(QIcon(tr(":/filter.png")), tr("Filter"), this);
    rightToolBar->addAction(filterAct);
    QAction* searchAct = new QAction(QIcon(tr(":/search.png")), tr("Search"), this);
    rightToolBar->addAction(searchAct);
    QAction* settingsAct = new QAction(QIcon(tr(":/settings.png")), tr("Settings"), this);
    rightToolBar->addAction(settingsAct);

    statusBar()->addWidget(new QLabel(tr("File Explorer Mode")));

//    view->AddItem("Item1");
//    view->AddItem("Item2");
//    view->AddItem("Item3");

    model->setRootPath(QDir::currentPath());
    model->setFilter(QDir::AllDirs | QDir::NoDotAndDotDot | QDir::Files);
    view->setModel(model);
    view->setAlternatingRowColors(true);
    view->setSelectionMode(QAbstractItemView::ExtendedSelection);

    setCentralWidget(view);
    setGeometry(50, 50, 800, 600);

    view->setColumnWidth(0, 400);
    view->header()->setSectionResizeMode(1, QHeaderView::ResizeToContents);
    view->header()->setSectionResizeMode(2, QHeaderView::ResizeToContents);
    view->header()->setSectionResizeMode(3, QHeaderView::ResizeToContents);
    view->header()->setSectionResizeMode(0, QHeaderView::Interactive);
    view->header()->setSectionResizeMode(1, QHeaderView::Interactive);
    view->header()->setSectionResizeMode(2, QHeaderView::Interactive);
    view->header()->setSectionResizeMode(3, QHeaderView::Interactive);


}

MainWindow::~MainWindow()
{
}


void MainWindow::about()
{
   QMessageBox::about(this, tr("About Hydra"),
            tr("If you cut off one head two more grow back!\n\nHail Hydra!"));
}

