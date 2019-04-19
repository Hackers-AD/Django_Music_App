from django.db import models
from django.contrib.auth.models import User
import datetime
from django.conf import settings


# Create your models here.
class UserPhoto(models.Model):
	user=models.ForeignKey(User,on_delete=models.CASCADE)
	profile_photo=models.ImageField(upload_to="image/userphotos",blank=True)
	cover_photo=models.ImageField(upload_to="image/userphotos",blank=True)
	image=models.ImageField(upload_to="image/userphotos",blank=True)
	file=models.FileField(upload_to='image/userfiles',blank=True)


class Profile(models.Model):
	user=models.ForeignKey(User,on_delete=models.CASCADE)
	nick_name=models.CharField(max_length=50,blank=True)
	profile_photo=models.ImageField(upload_to="image/profile",blank=True)
	cover_photo=models.ImageField(upload_to="image/cover",blank=True)
	temporary_address=models.CharField(max_length=50,blank=True)
	permanent_address=models.CharField(max_length=50,blank=True)
	place_lived=models.CharField(max_length=400,blank=True)
	birth_date=models.DateField(blank=True,null=True)
	sex=models.CharField(max_length=50,blank=True)
	about_you=models.CharField(max_length=500,blank=True)
	skill=models.CharField(max_length=500,blank=True)
	education_degree=models.CharField(max_length=500,blank=True)
	country=models.CharField(max_length=50,blank=True)
	language_known=models.CharField(max_length=200,blank=True)
	religion=models.CharField(max_length=50,blank=True)
	interested_in=models.CharField(max_length=50,blank=True)
	contact_num=models.IntegerField(default=0,blank=True)
	email=models.EmailField(blank=True)

	def __unicode__(self):
		return "%s%s%s%s%s" %(self.user,self.nick_name,self.birth_date,self.sex,self.country)

class Friend(models.Model):
	follow=models.ForeignKey(User,on_delete=models.CASCADE)
	follower=models.IntegerField(default=0,blank=True)
	follow_perm=models.BooleanField(blank=True,default=False)
	follower_perm=models.BooleanField(blank=True,default=False)
	datetime=models.DateTimeField(blank=True,null=True)

	def __unicode__(self):
		return "%s%s%s%s%s" %(self.follow,self.follower,self.follow_perm,self.follower_perm,self.datetime)

"""class AddFriend(models.Model):
	friend=models.ForeignKey(Friend,on_delete=models.CASCADE)"""
	

class Message(models.Model):
	user=models.ForeignKey(User,on_delete=models.CASCADE)
	friends=models.IntegerField(blank=True,null=True)
	def __unicode__(self):
		return "%s%s" %(self.user,self.friends)

class Conversation(models.Model):
	user=models.ForeignKey(Message,on_delete=models.CASCADE)
	sent=models.CharField(max_length=500,blank=True)
	received=models.CharField(max_length=500,blank=True)
	sent_pic=models.ImageField(upload_to='img/msg/sent',blank=True)
	received_pic=models.ImageField(upload_to='img/msg/recieved',blank=True)
	sent_file=models.FileField(upload_to='file/msg/sent',blank=True)
	received_file=models.FileField(upload_to='file/msg/recieved',blank=True)
	datetime=models.DateTimeField(blank=True,null=True)

	def __unicode__(self):
		return "%s%s%s%s" %(self.user.user,self.sent,self.recieved,self.datetime)

class Notification(models.Model):
	user=models.ForeignKey(User,on_delete=models.CASCADE)
	info=models.CharField(max_length=200,blank=True)
	source_id=models.IntegerField(default=0,blank=True)
	noteclass=models.CharField(max_length=50,blank=True)
	datetime=models.DateTimeField(blank=True,null=True)

	def __unicode__(self):
		return "%s%s%s%s" %(self.user,self.info,self.source_id,self.datetime)

class TrackNotification(models.Model):
	user=models.ForeignKey(User,on_delete=models.CASCADE)
	last_notify_count=models.IntegerField(default=0,blank=True)
	last_notify_index=models.IntegerField(default=0,blank=True)
	datetime=models.DateTimeField(blank=True,null=True)

	def __unicode__(self):
		return "%s%s%s%s" %(self.user,self.last_notify_count,self.last_notify_index,self.datetime)

class UserTracker(models.Model):
	user=models.ForeignKey(User,on_delete=models.CASCADE)
	last_seen=models.DateTimeField(blank=True,null=True)
	active_status=models.BooleanField(blank=True,default=True)

	def __unicode__(self):
		return "%s%s%s"% (self.user,self.last_seen,self.active_status)

	def is_online(self):
		now=datetime.datetime.now()
		present_sec=now.hour*60*60+now.minute*60+now.second;
		last_seen_sec=self.last_seen.hour*60*60+self.last_seen.minute*60+self.last_seen.second;

		if now.year==self.last_seen.year:
			if now.month==self.last_seen.month:
				if now.day==self.last_seen.day:
					if(present_sec-last_seen_sec)<settings.ACTIVE_TIMEOUT:
						return True
		return False