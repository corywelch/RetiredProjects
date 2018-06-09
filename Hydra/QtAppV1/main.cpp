#include "mainwindow.h"
#include <QApplication>
#include <QFile>

int main(int argc, char *argv[])
{
    Q_INIT_RESOURCE(hydra);

    QApplication app(argc, argv);
    app.setOrganizationName("HackerCentral");
    app.setApplicationName("QtTestApp1");

    QFile file(":/dark.qss");
    file.open(QFile::ReadOnly);
    QString styleSheet = QString::fromLatin1(file.readAll());
    app.setStyleSheet(styleSheet);

    MainWindow wnd;
    wnd.show();

    return app.exec();
}
