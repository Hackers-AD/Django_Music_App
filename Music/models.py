from django.db import models
from django.contrib.auth.models import User

# Create your models here.
class Album(models.Model):
	user=models.ForeignKey(User,on_delete=models.CASCADE)
	album_title=models.CharField(max_length=100,blank=True)
	album_logo=models.ImageField(upload_to="music/album/logo",blank=True)
	album_artist=models.CharField(max_length=70,blank=True)
	album_genre=models.CharField(max_length=70,blank=True)
	likes=models.IntegerField(default=0,blank=True)
	dislikes=models.IntegerField(default=0,blank=True)
	published_date=models.DateField(blank=True,null=True)

	def __unicode__(self):
		return "%s%s%s%s%s"%(self.user,self.album_title,self.likes,self.dislikes,self.published_date)

class Playlist(models.Model):
	user=models.ForeignKey(User,on_delete=models.CASCADE)
	name=models.CharField(max_length=60,blank=True)
	cover=models.ImageField(upload_to="music/playlist/cover",blank=True)
	song_number=models.IntegerField(default=0,blank=True)
	is_favourite=models.BooleanField(blank=True,default=False)
	created_date=models.DateField(blank=True,null=True)

	def __unicode__(self):
		return "%s%s%s"%(self.user,self.name,self.created_date)

class Song(models.Model):
	user=models.ForeignKey(User,on_delete=models.CASCADE)
	song_title=models.CharField(max_length=100,blank=True)
	song_genre=models.CharField(max_length=70,blank=True)
	song_artist=models.CharField(max_length=70,blank=True)
	date=models.DateField(blank=True,null=True)
	song_file=models.FileField(upload_to="music/song/file",blank=True)
	lyrics_file=models.FileField(upload_to="music/song/lyrics",blank=True)
	lyrics=models.CharField(max_length=2500,blank=True)
	likes=models.IntegerField(default=0,blank=True)
	dislikes=models.IntegerField(default=0,blank=True)
	downloads=models.IntegerField(default=0,blank=True)
	album_id=models.CharField(max_length=5000,blank=True)
	playlist_id=models.CharField(max_length=5000,blank=True)

	def __unicode__(self):
		return "%s%s%s%s%s%s%s%s%s"%(self.user,self.song_title,self.song_artist,self.likes,self.dislikes,self.downloads,self.album_id,self.playlist_id,self.date)

class Feed(models.Model):
	user=models.ForeignKey(User,on_delete=models.CASCADE)
	song_id=models.IntegerField(default=0,blank=True)
	album_id=models.IntegerField(default=0,blank=True)
	likes=models.BooleanField(blank=True)
	dislikes=models.BooleanField(blank=True)

	def __unicode__(self):
		return "%s%s%s%s%s"%(self.user,self.song_id,self.album_id,self.likes,self.dislikes)

class Comment(models.Model):
	user=models.ForeignKey(User,on_delete=models.CASCADE)
	song_id=models.IntegerField(default=0,blank=True)
	album_id=models.IntegerField(default=0,blank=True)
	comment=models.CharField(max_length=200,blank=True)
	image=models.ImageField(upload_to="music/song/comment_img",blank=True)
	file=models.FileField(upload_to="music/song/comment_file",blank=True)
	datetime=models.DateTimeField(blank=True,null=True)

	def __unicode__(self):
		return "%s%s%s%s%s"%(self.user,self.song_id,self.album_id,self.comment,self.datetime)
	
		