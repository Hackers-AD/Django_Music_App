from django.shortcuts import render,redirect
from django.contrib.auth import authenticate,login,logout
from django.contrib.auth.decorators import login_required
from django.http import HttpResponse,HttpResponseRedirect
from django.contrib.auth.models import User
from UserAdministration.models import *
from django.conf import settings
from django.contrib import messages
from .models import *
#import matplotlib
import datetime
import random
import re
from django.http import HttpResponse
from django.utils.translation import gettext as _

# Create your views here.
def index(request,status=None):
	msgs=messages.get_messages(request)
	albums=Album.objects.all()
	songs=Song.objects.all()
	if len(albums)>=9:
		albums=random.sample(list(albums),9)
	if len(albums)<9:
		albums=random.sample(list(albums),len(albums))

	trendingsongs=[]
	trendingalbums=[]
	filteredsong=[]
	filteredalbum=[]
	songcount=0
	albumcount=0
	try:
		trendingalbums=Album.objects.order_by("likes")
		trendingsongs=Song.objects.order_by("likes")
	except Exception as e:
		pass
	for song in reversed(trendingsongs):
		if songcount>7:
			pass
		else:
			filteredsong.append(song)
			songcount=songcount+1
	for album in reversed(trendingalbums):
		if albumcount>7:
			pass
		else:
			filteredalbum.append(album)
			albumcount=albumcount+1
	trendingsongs=filteredsong
	trendingalbums=filteredalbum

	artistsongs=[]
	artistalbums=[]
	try:
		artistalbums=Album.objects.order_by("album_artist")
		artistsongs=Song.objects.order_by("song_artist")
	except Exception as e:
		pass

	notifications=None
	tracknotify=None
	if request.user.is_authenticated:
		notifications=Notification.objects.filter(user=request.user)
		tracknotify=TrackNotification.objects.filter(user=request.user)
	if tracknotify:
		last_tracked_notify=list(reversed(tracknotify))[0]
	else:
		last_tracked_notify=None
	if notifications:
		last_notify=list(reversed(notifications))[0]
	else:
		last_notify=None

	notifycount=0
	if last_notify and last_tracked_notify:
		for notification in reversed(notifications):
			if notification.id > last_tracked_notify.last_notify_index:
				notifycount=notifycount+1

	request.session.set_test_cookie()
	if request.session.test_cookie_worked():
		request.session.delete_test_cookie()
		request.session['behindbrowser']=request.META['HTTP_USER_AGENT']
	return render(request,"music/index.php",{'albums':albums,'songs':songs,'trendingalbums':trendingalbums,'trendingsongs':trendingsongs,'artistalbums':artistalbums,'artistsongs':artistsongs,'msgs':msgs,'notifycount':notifycount})

@login_required
def profile(request,user):
	pp=None
	cp=None
	try:
		User.objects.get(username=user)
	except:
		return HttpResponse("Anonymous User")
	try:
		profile=Profile.objects.get(user=request.user)
	except Exception as e:
		profile=Profile.objects.create(user=request.user)

	if request.method=='POST':
		if request.FILES.get('pp',""):
			pp=request.FILES['pp']

		if request.FILES.get('cp',""):
			cp=request.FILES['cp']

		try:
			profile=Profile.objects.get(user=request.user)
		except Exception as e:
			profile=None
		if pp:
			if profile:
				userphoto=UserPhoto(user=request.user)
				userphoto.profile_photo=profile.profile_photo
				profile.profile_photo=request.FILES['pp']
				profile.save()
				userphoto.save()
		if cp:
			if profile:
				userphoto=UserPhoto(user=request.user)
				userphoto.profile_photo=profile.cover_photo
				profile.cover_photo=request.FILES['cp']
				profile.save()
				userphoto.save()

		return redirect("/tubelight/%s/"%request.user)
	return render(request,"music/profile.php",{'profile':profile})

@login_required
def edit_profile(request):
	try:
		profile=Profile.objects.get(user=request.user)
	except Exception as e:
		profile=None

	return render(request,'music/editprofile.php',{'profile':profile})

@login_required
def settings(request):
	delerror=None
	try:
		profile=Profile.objects.get(user=request.user)
	except Exception as e:
		profile=None

	if request.method=='POST':
		if request.POST.get('delete',""):
			password=request.POST['password']
			username=request.user.username
			try:
				deleteuser=authenticate(username=username,password=password)
				if deleteuser is not None:
					deleteuser.delete()
					messages.add_message(request,messages.INFO,'Account Deleted Sucessfully.')
					return redirect('/')
				else:
					delerror=True
			except Exception as e:
				print("OKay xainas \n\n")

	return render(request,'music/settings.php',{'profile':profile,'delerror':delerror})

def generalsettings(request):
	return render(request,'music/generalsettings.php',{})
def messagesettings(request):
	return render(request,'music/messagesettings.php',{})
def musicsettings(request):
	return render(request,'music/musicsettings.php',{})
def notifysettings(request):
	return render(request,'music/notifysettings.php',{})
def profilesettings(request):
	return render(request,'music/profilesettings.php',{})

@login_required
def redirectsettings(request,category):
	if category=="general":
		return generalsettings(request)
	if category=="messages":
		return messagesettings(request)
	if category=="musics":
		return musicsettings(request)
	if category=="notify":
		return notifysettings(request)
	if category=="profile":
		return profilesettings(request)

def songlist(request,category):
	if category=="album":
		try:
			albums=Album.objects.all()
			if len(albums)>=9:
				albums=random.sample(list(albums),9)
			if len(albums)>=5:
				albums=random.sample(list(albums),5)
			if len(albums)<=4:
				albums=random.sample(list(albums),len(albums))
		except Exception as e:
			albums=None

		return render(request,"music/album.php",{'albums':albums})
	if category=="trending":
		songs=[]
		albums=[]
		filteredsong=[]
		filteredalbum=[]
		songcount=0
		albumcount=0
		try:
			albums=Album.objects.order_by("likes")
			songs=Song.objects.order_by("likes")
		except Exception as e:
			pass
		for song in reversed(songs):
			if songcount>7:
				pass
			else:
				filteredsong.append(song)
				songcount=songcount+1

		for album in reversed(albums):
			if albumcount>7:
				pass
			else:
				filteredalbum.append(album)
				albumcount=albumcount+1

		songs=filteredsong
		albums=filteredalbum
		return render(request,"music/trending.php",{'albums':albums,'songs':songs})
	if category=="artist":
		songs=[]
		albums=[]
		try:
			albums=Album.objects.order_by("album_artist")
			songs=Song.objects.order_by("song_artist")
		except Exception as e:
			pass
		return render(request,"music/artist.php",{'albums':albums,'songs':songs})
	if category=="song":
		try:
			songs=Song.objects.all()
			if len(songs)>=9:
				songs=random.sample(list(songs),9)
			elif len(songs)>=5:
				songs=random.sample(list(songs),5)
			else:
				songs=random.sample(list(songs),len(songs))
		except Exception as e:
			songs=None
		print(songs)
		return render(request,"music/song.php",{'songs':songs})
	if category=="lyric":
		return render(request,"music/lyric.php",{'user':request.user})

def usersong(request,user,category):
	if category=="album":
		try:
			albums=Album.objects.filter(user=request.user)
		except Exception as e:
			albums=None

		return render(request,"music/album.php",{'albums':albums})
	if category=="likedsong":
		return render(request,"music/likedsong.php",{'user':request.user})
	if category=="playlist":
		playlists=Playlist.objects.filter(user=request.user)
		return render(request,"music/myplaylist.php",{'playlists':playlists})

def albumsongs(request,album_id):
	songs=[]
	allsongs=Song.objects.all()
	for song in allsongs:
		song_album_id=song.album_id.split(",")
		for a_id in song_album_id:
			if a_id==album_id:
				songs.append(song)
	album=Album.objects.get(id=album_id)
	comments=Comment.objects.filter(album_id=album_id)
	albums=Album.objects.all()

	if request.user.is_authenticated:
		try:
			profile=Profile.objects.get(user=request.user)
		except Exception as e:
			profile=None
	else:
		profile=None
	try:
		profiles=Profile.objects.all()
	except Exception as e:
		pass

	return render(request,"music/albumsongs.php",{'album_id':album_id,'album':album,'albums':albums,'songs':songs,'profile':profile,'profiles':profiles,'comments':comments})

def songs(request):
	songs=Song.objects.all()
	songs=random.sample(list(songs),len(songs))
	if request.user.is_authenticated:
		try:
			profile=Profile.objects.get(user=request.user)
		except Exception as e:
			profile=None
	else:
		profile=None
	try:
		profiles=Profile.objects.all()
	except Exception as e:
		pass

	return render(request,"music/songs.php",{'songs':songs,'profile':profile,})

def uploadsong(request):
	songfile=None
	message=False
	lyrics=None
	songtitle=None
	genre=None
	artist=None
	lyrictyped=None
	var=""
	if request.user.is_authenticated:
		try:
			profile=Profile.objects.get(user=request.user)
		except Exception as  e:
			profile=None
	else:
		profile=None
	if request.method=="POST":

		if request.FILES.get('songfile',""):
		 	songfile=request.FILES['songfile']
		if request.FILES.get('lyrics',""):
		 	lyrics=request.FILES['lyrics']
		if request.POST.get('title',""):
		 	songtitle=request.POST['title']
		if request.POST.get('genre',""):
		 	genre=request.POST['genre']
		if request.POST.get('artist',""):
		 	artist=request.POST['artist']
		if request.POST.get('lyrictyped',""):
		 	lyrictyped=request.POST['lyrictyped']
		if request.user.is_authenticated:
			songuser=request.user
		else:
			songuser=User.objects.get(id=1)

		if songtitle:
		    wordlist=(songtitle.split("_"))
		else:
		    wordlist=[]
		if len(wordlist)>1:
			for x in wordlist:
				var=var+" "+x;
			songtitle=var

		if songfile:
			newsong=Song(user=songuser,song_file=songfile)
			if songtitle:
				newsong.song_title=songtitle
			if genre:
				newsong.song_genre=genre
			if artist:
				newsong.song_artist=artist
			if lyrics:
				newsong.lyrics_file=lyrics
			if lyrictyped:
				newsong.lyrics=lyrictyped
			newsong.date=datetime.date.today()
			newsong.save()
			return redirect("/uploadsongsuccess/")

	return render(request,"music/uploadsong.php",{'profile':profile,})

def uploadsongsuccess(request):
	if request.user.is_authenticated:
		try:
			profile=Profile.objects.get(user=request.user)
		except Exception as e:
			profile=None
	else:
		profile=None

	return render(request,"music/uploadsongsucess.php",{'profile':profile,})

def newalbum(request):
	albumlogo=None
	albumtitle=None
	genre=None
	artist=None
	if request.user.is_authenticated:
		try:
			profile=Profile.objects.get(user=request.user)
		except Exception as e:
			profile=None
	else:
		profile=None
	if request.method=="POST":

		if request.FILES.get('imagefile',""):
		 	albumlogo=request.FILES['imagefile']

		if request.POST.get('title',""):
		 	albumtitle=request.POST['title']

		if request.POST.get('genre',""):
		 	genre=request.POST['genre']

		if request.POST.get('artist',""):
		 	artist=request.POST['artist']

		if request.user.is_authenticated:
			albumuser=request.user
		else:
			albumuser=User.objects.get(id=1)

		if albumtitle and artist:
			newalbum=Album(user=albumuser,album_title=albumtitle,album_artist=artist)
			if albumlogo:
				newalbum.album_logo=albumlogo
			else:
				pass
			if genre:
				newalbum.album_genre=genre

			newalbum.published_date=datetime.date.today()
			newalbum.save()
			return redirect("/albumcreatesuccess/%s/"%(newalbum.id))
	return render(request,"music/newalbum.php",{'profile':profile,})

def albumcreatesuccess(request,album_id):
	if request.user.is_authenticated:
		try:
			profile=Profile.objects.get(user=request.user)
		except Exception as e:
			profile=None
	else:
		profile=None

	return render(request,"music/albumcreatesuccess.php",{'profile':profile,'album_id':album_id})

def albumaddsong(request,album_id):
	albumacess=False
	songs=Song.objects.all()
	songs=random.sample(list(songs),len(songs))
	var=""
	for song in songs:
		wordlist=(song.song_title.split("_"))
		if len(wordlist)>1:
			for x in wordlist:
				var=var+" "+x;
			song.song_title=var
			var=""
	"""if len(songs)<9:
		songs=random.sample(list(songs),len(songs))
	else:
		songs=random.sample(list(songs),9)"""
	#for song in songs:
		#song.album_id=song.album_id.split(",")
	try:
		album=Album.objects.get(id=album_id)
	except Exception as e:
		album=None
	if album:
	    if album.user.id==1 or album.user==request.user:
	        albumacess=True

	if request.user.is_authenticated:
		try:
			profile=Profile.objects.get(user=request.user)
		except Exception as e:
			profile=None
	else:
		profile=None

	if request.method=="POST":
		print(request.POST)
		if request.POST.get('addsong',"") and request.POST.get('checked',""):
			song_id=request.POST['addsong']
			song=Song.objects.get(id=song_id)
			if album:
				song.album_id=song.album_id+","+album_id
				song.save()
				return redirect("/album/%s/addsong/"%(album_id))
		if request.POST.get('trash',""):
			song_id=request.POST['trash']
			song=Song.objects.get(id=song_id)
			if album:
				ids=song.album_id.split(",")
				print(ids)
				id_list=[]
				for x in ids:
					if x is album_id or '':
						pass
					else:
						id_list.append(x)

				song.album_id=','.join(id_list)
				song.save()
				return redirect("/album/%s/addsong/"%(album_id))

	return render(request,"music/albumaddsong.php",{'profile':profile,'songs':songs,'album_id':album_id,'albumacess':albumacess,'album':album})

def playlistcreatesuccess(request,playlist_id):
	if request.user.is_authenticated:
		try:
			profile=Profile.objects.get(user=request.user)
		except Exception as e:
			profile=None
	else:
		profile=None

	return render(request,"music/playlistcreatesuccess.php",{'profile':profile,'playlist_id':playlist_id})

def newplaylist(request):
	playlistcover=None
	playlistname=None

	if request.user.is_authenticated:
		try:
			profile=Profile.objects.get(user=request.user)
		except Exception as e:
			profile=None
	else:
		profile=None

	if request.method=="POST":
		if request.FILES.get('imagefile',""):
		 	playlistcover=request.FILES['imagefile']

		if request.POST.get('title',""):
		 	playlistname=request.POST['title']

		if request.user.is_authenticated:
			playlistuser=request.user
		else:
			playlistuser=User.objects.get(id=1)

		if playlistname:
			newplaylist=Playlist(user=playlistuser,name=playlistname,created_date=datetime.date.today())
			if playlistcover:
				newplaylist.cover=playlistcover
			newplaylist.save()
			return redirect("/playlistcreatesuccess/%s/"%(newplaylist.id))

	return render(request,"music/newplaylist.php",{'profile':profile,})


def playlistsongs(request,playlist_id):
	songs=[]
	allsongs=Song.objects.all()
	for song in allsongs:
		song_playlist_id=song.playlist_id.split(",")
		for a_id in song_playlist_id:
			if a_id==playlist_id:
				songs.append(song)
	playlist=Playlist.objects.get(id=playlist_id)
	playlists=Playlist.objects.filter(user=request.user)

	if request.user.is_authenticated:
		try:
			profile=Profile.objects.get(user=request.user)
		except Exception as e:
			profile=None
	else:
		profile=None
	try:
		profiles=Profile.objects.all()
	except Exception as e:
		pass

	return render(request,"music/playlistsongs.php",{'playlist_id':playlist_id,'playlist':playlist,'playlists':playlists,'songs':songs,'profile':profile,'profiles':profiles,})

def playlistaddsong(request,playlist_id):
	playlistacess=None
	songs=Song.objects.all()
	songs=random.sample(list(songs),len(songs))
	var=""
	for song in songs:
		wordlist=(song.song_title.split("_"))
		if len(wordlist)>1:
			for x in wordlist:
				var=var+" "+x;
			song.song_title=var
			var=""
	try:
		playlist=Playlist.objects.get(id=playlist_id)
	except Exception as e:
		playlist=None

	if playlist and playlist.user==request.user:
		playlistacess=True

	if request.user.is_authenticated:
		try:
			profile=Profile.objects.get(user=request.user)
		except Exception as e:
			profile=None
	else:
		profile=None

	if request.method=="POST":
		if request.POST.get('addsong',"") and request.POST.get('checked',""):
			song_id=request.POST['addsong']
			song=Song.objects.get(id=song_id)
			if playlist:
				song.playlist_id=song.playlist_id+","+playlist_id
				song.save()
				return redirect("/playlist/%s/addsong/"%(playlist_id))
		if request.POST.get('trash',""):
			song_id=request.POST['trash']
			song=Song.objects.get(id=song_id)
			if playlist:
				ids=song.playlist_id.split(",")
				print(ids)
				id_list=[]
				for x in ids:
					if x is playlist_id or '':
						pass
					else:
						id_list.append(x)

				song.playlist_id=','.join(id_list)
				song.save()
				return redirect("/playlist/%s/addsong/"%(playlist_id))

	return render(request,"music/playlistaddsong.php",{'profile':profile,'songs':songs,'playlist_id':playlist_id,'playlistacess':playlistacess,'playlist':playlist})
