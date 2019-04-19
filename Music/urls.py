from django.conf.urls import url,include
from django.conf import settings
from django.conf.urls.static import static
from . import views

urlpatterns = [
    url(r'^tubelight/(?P<user>[A-Za-z0-9@_\.-]+)/$', views.profile,name='profile'),
    url(r'^songlist/(?P<category>[a-z]+)/$', views.songlist,name='songlist'),
    url(r'^songlist/(?P<user>[A-Za-z0-9@_\.-]+)/(?P<category>[a-z]+)/$', views.usersong,name='usersong'),
    url(r'^tubelight/$',views.index,name="home"),
    url(r'^profile/edit/$',views.edit_profile,name="edit_profile"),
    url(r'^settings/$',views.settings,name="settings"),
    url(r'^songs/$',views.songs,name="songs"),
    url(r'^uploadsong/$',views.uploadsong,name="uploadsong"),
    url(r'^uploadsongsuccess/$',views.uploadsongsuccess,name="uploadsongsuccess"),
    url(r'^createalbum/$',views.newalbum,name="newalbum"),
    url(r'^albumcreatesuccess/(?P<album_id>[0-9]+)/$',views.albumcreatesuccess,name="albumcreatesuccess"),
    url(r'^album/(?P<album_id>[0-9]+)/addsong/$',views.albumaddsong,name="albumaddsong"),
    url(r'^createplaylist/$',views.newplaylist,name="newplaylist"),
    url(r'^playlistcreatesuccess/(?P<playlist_id>[0-9]+)/$',views.playlistcreatesuccess,name="playlistcreatesuccess"),
    url(r'^playlist/(?P<playlist_id>[0-9]+)/songs/$',views.playlistsongs,name="playlistsongs"),
    url(r'^playlist/(?P<playlist_id>[0-9]+)/addsong/$',views.playlistaddsong,name="playlistaddsong"),
    url(r'^settings/(?P<category>[a-z]+)/$',views.redirectsettings,name="redirectsettings"),

    #album url
    url(r'^album/songs/(?P<album_id>[0-9]+)/$',views.albumsongs,name="albumsongs"),
    url(r'^$',views.index,{'status':""},name="index"),
]+static(settings.MEDIA_URL,document_root=settings.MEDIA_ROOT)
