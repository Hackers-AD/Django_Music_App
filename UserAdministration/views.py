from django.http import HttpResponse,HttpResponseRedirect,request
from django.shortcuts import render,redirect
from django.contrib.auth.decorators import login_required
from django.contrib.auth import authenticate,login,logout
from django.contrib import messages as msgframe
from django.core.mail import send_mail
from .models import *
from Music.models import *
#import matplotlib
import datetime
import random
import re


# Create your views here.
def index(request):
	return HttpResponse("user admin index")

@login_required
def message(request,msg_id):
	conversationlist=[]
	if not msg_id:
		try:
			conversations=Conversation.objects.all()
			for x in reversed(conversations):
				if x.user.user==request.user:
					conversationlist.append(x)
			if conversationlist:
				msg_id=conversationlist[0].user.friends
		except Exception as e:
			pass
	print("message id is ", msg_id)
	profile=Profile.objects.get(user=request.user)

	return render(request,"account/message.php",{'profile':profile,'msg_id':msg_id})

def messagelist(request):
	chats=[]
	cons=[]
	profiles=[]
	holder=None
	trackusers=UserTracker.objects.all()
	try:
		profile=Profile.objects.get(user=request.user)
	except:
		profile=None
	try:
		messages=Message.objects.filter(user=request.user)
	except Exception as e:
		messages=None
	for message in messages:
		try:
			profiles.append(Profile.objects.get(user=User.objects.get(id=message.friends)))
		except Exception as e:
			print('No Profile for id ',message.friends)
		try:
			chats.append(Conversation.objects.filter(user=message))
		except Exception as e:
			pass
	for chat in chats:
		for x in chat:
			cons.append(x)

	if cons:
		holder=cons[0]
		for x in range(0,len(cons)):
			for y in range(x,len(cons)):
				if cons[y].datetime.year==cons[x].datetime.year:
					if cons[y].datetime.month*30+cons[y].datetime.day >= cons[x].datetime.month*30+cons[x].datetime.day:
						if (cons[y].datetime.hour*60*60+cons[y].datetime.minute*60+cons[y].datetime.second)  > (cons[x].datetime.hour*60*60+cons[x].datetime.minute*60+cons[x].datetime.second):
						    cons[x]=cons[y]
						    cons[y]=holder
						    holder=cons[x]
				elif cons[y].datetime.year > cons[x].datetime.year:
					cons[x]=cons[y]
					cons[y]=holder
					holder=cons[x]
				else:pass
	order_msg=[]
	last_con=[]
	for x in (cons):
		if x.user in order_msg:
			pass
		else:
			order_msg.append(Message.objects.get(user=x.user.user,friends=x.user.friends))
			last_con.append(x)

	return render(request,"account/messagelist.php",{'profile':profile,'order_msg':order_msg,'profiles':profiles,'last_con':last_con,'trackusers':trackusers})

@login_required
def conversation(request,msg_id):
	try:
		senderprofile=Profile.objects.get(user=request.user)
	except Exception as e:
		senderprofile=None
	try:
		receiverprofile=Profile.objects.get(user=User.objects.get(id=msg_id))
	except Exception as e:
		receiverprofile=None
	try:
		message=Message.objects.get(user=request.user,friends=msg_id)
		conversations=Conversation.objects.filter(user=message)
	except Exception as e:
		conversations=None
	if conversations:
		old_msg_count=len(conversations)
	else:
		old_msg_count=0

	return render(request,"account/conversation.php",{'msg_id':msg_id,'conversations':conversations,'senderprofile':senderprofile,'receiverprofile':receiverprofile,'old_msg_count':old_msg_count,})

def refreshmsg(request,msg_id,old_count):
	new_message=False
	try:
		message=Message.objects.get(user=request.user,friends=msg_id)
		conversations=Conversation.objects.filter(user=message)
	except Exception as e:
		conversations=None
	if conversations:
		new_count=len(conversations)
	else:
		new_count=0
	if new_count>int(old_count):
		new_message=True
		print("New Message Arrived.")

	return render(request,"account/refreshmsg.php",{'msg_id':msg_id,'old_count':old_count,'new_message':new_message})

def msgimage(request,conv_id,msg_id):
	try:
		conversation=Conversation.objects.get(id=conv_id)
	except Exception as e:
		conversation=None

	return render(request,"account/msgimage.php",{'msg_id':msg_id,'conversation':conversation,})

@login_required
def recordmsg(request,msg_id):
	message=None
	image=None
	file=None
	like=None

	if request.method=='POST':
		now=datetime.datetime.now()

		if request.POST.get('message',""):
			message=request.POST['message']
		if request.FILES.get('image',""):
			image=request.FILES['image']
		if request.FILES.get('file',""):
			file=request.FILES['file']
		if request.POST.get('thumbsup',""):
			like=request.POST['thumbsup']

		print(message,like)
		if message or image or file or like:
			try:
				sender=Message.objects.get(user=request.user,friends=msg_id)
			except Exception as e:
				sender=Message.objects.create(user=request.user,friends=msg_id)
			try:
				receiver=Message.objects.get(user=User.objects.get(id=msg_id),friends=request.user.id)
			except Exception as e:
				receiver=Message.objects.create(user=User.objects.get(id=msg_id),friends=request.user.id)
			
			sender_record=Conversation(user=sender,datetime=now)
			receiver_record=Conversation(user=receiver,datetime=now)

			if message:
				sender_record.sent=request.POST['message']
				receiver_record.received=request.POST['message']
			if request.FILES.get('image',""):
				sender_record.sent_pic=request.FILES['image']
				receiver_record.received_pic=request.FILES['image']
			if request.FILES.get('file',""):
				sender_record.sent_file=request.FILES['file']
				receiver_record.received_file=request.FILES['file']

			sender_record.save()
			receiver_record.save()
		else:
			pass

	return render(request,"account/recordmsg.php",{'msg_id':msg_id})

@login_required
def activefriend(request):
	friends=Friend.objects.filter(follow=request.user)
	profiles=Profile.objects.all()
	trackusers=UserTracker.objects.all()
	followapproveuser=False
	followpendinguser=False
	pendingrequest=None
	if friends:
		for friend in friends:
			for trackuser in trackusers:
				if trackuser.is_online():
					if trackuser.user.id==friend.follower:
						if friend.follow_perm:
							followapproveuser=True
						else:
							followpendinguser=True
	nouseronline=True
	for friend in friends:
		for trackuser in trackusers:
			if trackuser.user.id==friend.follower:
				if trackuser.is_online() and friend.follow_perm:
					nouseronline=False

	if not followapproveuser and followpendinguser:
		pendingrequest=True
	if request.GET.get('onoff',""):
		try:
			trackuser=UserTracker.objects.get(user=request.user)
			if trackuser.active_status:
				trackuser.active_status=False
			else:
				trackuser.active_status=True
			trackuser.save()
			return redirect("/account/activefriend/")
		except Exception as e:
			pass
	try:
		chat_status=UserTracker.objects.get(user=request.user).active_status
	except Exception as e:
		chat_status=None

	return render(request,"account/activefriend.php",{'nouseronline':nouseronline,'chat_status':chat_status,'friends':friends,'profiles':profiles,'trackusers':trackusers,'pendingrequest':pendingrequest})

def login_view(request):
	errors=[]
	email=""
	password=""
	user=None
	if request.user.is_authenticated:
		return redirect('/')
	messages=msgframe.get_messages(request)
	if request.method=='POST':
		email=request.POST['email']
		password=request.POST['password']
		try:
			user=User.objects.get(email=email)
		except Exception as e:
			pass
		try:
			user=User.objects.get(username=email)
		except:
			pass

		if request.session.test_cookie_worked():
			print("test cookie worked")
		else:
			return HttpResponse("<center><h1>Please enable cookie to continue.</h1><center>")

		if user:
			checkuser=authenticate(username=user.username,password=password)
		else: 
			checkuser=None

		if checkuser is not None and checkuser.is_active:
			try:
			    login(request,checkuser)
			    #request.session[str(user.id)]="is_active"
			    msgframe.add_message(request,msgframe.INFO,"You are Sucessfully logged In.")
			    return redirect("/")
			except:
			    errors.append("Internal Server Error.")
		else:
			errors.append("Invalid email or password.")
	
	request.session.set_test_cookie()
	return render(request,'account/login.php',{'errors':errors,'email':email,'messages':messages})

def signup(request):
	errors=[]
	email=""
	fullname=""
	username=""
	password=""
	if request.user.is_authenticated:
		return redirect('/')

	if request.method=='POST':
		email=request.POST['email']
		password=request.POST['npass']
		username=request.POST['username']
		if request.POST.get('fname',""):
		    fullname=request.POST['fname']
		try:
			User.objects.get(username=username)
			errors.append("Username already taken.")
		except Exception as e:
			pass
		try:
			User.objects.get(email=email)
			errors.append("An account is already exist with this email.")
		except Exception as e:
			pass
		if not errors:
			try:
				send_mail('TubeLight SignUp','Account Sucessfully Created. See Site at http://connect.pythonanywhere.com','innovativename05@gmail.com',[email],fail_silently=False)
				user=User.objects.create_user(username=username,email=email,password=password)
				user.is_staff=True
				if request.POST.get('fname',""):
					user.first_name=fullname
				user.save()
				notifyobj=Notification.objects.create(user=user,info="Your Account is Created Sucessfully.",source_id=user.id,noteclass="info",datetime=datetime.datetime.now())
				TrackNotification.objects.create(user=user,last_notify_index=notifyobj.id,last_notify_count=0,datetime=datetime.datetime.now())
				Profile.objects.create(user=user)
				UserTracker.objects.create(user=user,last_seen=datetime.datetime.now())
				msgframe.add_message(request,msgframe.INFO,'Account Created Sucessfully.')
				return HttpResponseRedirect("/account/login/")
			except Exception as e:
				raise e
				errors.append("Invalid email address.")
	"""
		user=User.objects.create_user(username=request.POST['username'],password=request.POST['password'],email=request.POST['email'],first_name=request.POST['first_name'],last_name=request.POST['last_name'])
		user.is_staff=True
		user.save()tl
	"""
	return render(request,'account/signup.php',{'errors':errors,'email':email,'username':username,'password':password,'fn':fullname})
def addfriend(request):
	users=User.objects.all()
	profiles=Profile.objects.all()
	myfriends=Friend.objects.filter(follow=request.user,follow_perm=True,follower_perm=True)
	followerfriends=Friend.objects.filter(follow=request.user,follow_perm=False,follower_perm=True)
	followedfriends=Friend.objects.filter(follower=request.user.id,follow_perm=False,follower_perm=True)
	unfollowedusers=[]
	ownfriends=[]
	followers=[]
	followeds=[]
	for fan in followerfriends:
		followers.append(User.objects.get(id=fan.follower))
	for idol in followedfriends:
		followeds.append(User.objects.get(id=idol.follow.id))
	for user in users:
		checkfriend=False
		for x in myfriends:
			if x.follower is user.id:
				checkfriend=True
		if checkfriend:
			ownfriends.append(user)

	allfriends=Friend.objects.filter(follow=request.user)
	for user in users:
		checkfollow=False
		for myfriend in allfriends:
			if user.id is myfriend.follower:
				checkfollow=True
		if not checkfollow:
			unfollowedusers.append(user)
	mutualfriends={}
	for user in users:
		count=0
		userfriends=Friend.objects.filter(follow=user,follow_perm=True)
		for userfriend in userfriends:
			for myfriend in myfriends:
				if myfriend.follower is userfriend.follower:
					count=count+1
		mutualfriends[user]=count

	if len(unfollowedusers)>9:
		sugusers=random.sample(list(unfollowedusers),9)
	else:
		sugusers=random.sample(list(unfollowedusers),len(unfollowedusers))
	try:
		profile=Profile.objects.get(user=request.user)
	except Exception as e:
		profile=None

	if request.method=='GET':
		if request.GET.get('follow',""):
			now=datetime.datetime.now()
			follow_id=request.GET['follow']
			follow=User.objects.get(id=follow_id)
			try:
				friendobj=Friend.objects.get(follow=follow,follower=request.user.id)
			except Exception as e:
				Friend.objects.create(follow=follow,follower=request.user.id,follower_perm=True,datetime=now)
			try:
				friendobj=Friend.objects.get(follow=request.user,follower=follow_id,follow_perm=True)
			except Exception as e:
				Friend.objects.create(follow=request.user,follower=follow_id,follow_perm=True,datetime=now)
			return redirect('/account/addfriend/')

		if request.GET.get('unfollow',""):
			unfollow_id=request.GET['unfollow']
			unfollow=User.objects.get(id=unfollow_id)
			try:
				friendobj=Friend.objects.get(follow=unfollow,follower=request.user.id)
				try:
					message=Message.objects.get(user=unfollow,friends=request.user.id)
					message.delete()
				except Exception as e:
					pass
				friendobj.delete()
			except Exception as e:
				print("Unfollow Exception occured")
			try:
				friendobj=Friend.objects.get(follow=request.user,follower=unfollow_id,follow_perm=True)
				try:
					message=Message.objects.get(user=request.user,friends=unfollow_id)
					message.delete()
				except Exception as e:
					pass
				friendobj.delete()
			except Exception as e:
				print("Unfollow Exception occured")
			return redirect('/account/addfriend/')

		if request.GET.get('approve',""):
			approve_id=request.GET['approve']
			follower=User.objects.get(id=approve_id)
			try:
				friendobj=Friend.objects.get(follow=request.user,follower=approve_id)
				friendobj.follow_perm=True
				friendobj.save()
			except Exception as e:
				pass
			try:
				friendobj=Friend.objects.get(follow=follower,follower=request.user.id)
				friendobj.follower_perm=True
				friendobj.save()
			except Exception as e:
				pass
			return redirect('/account/addfriend/')

		if request.GET.get('delrequest',""):
			delrequest_id=request.GET['delrequest']
			follower=User.objects.get(id=delrequest_id)
			try:
				friendobj=Friend.objects.get(follow=request.user,follower=delrequest_id)
				try:
					message=Message.objects.get(user=request.user,friends=delrequest_id)
					message.delete()
				except Exception as e:
					pass
				friendobj.delete()
				friendobj=Friend.objects.get(follow=follower,follower=request.user.id)
				try:
					message=Message.objects.get(user=follower,friends=request.user.id)
					message.delete()
				except Exception as e:
					pass
				friendobj.delete()
			except Exception as e:
				pass
			return redirect('/account/addfriend/')

	return render(request,'account/addfriend.html',{'followeds':followeds,'followers':followers,'mutualfriends':mutualfriends,'profile':profile,'sugusers':sugusers,'ownfriends':ownfriends,'profiles':profiles})
 
def seeprofile(request,user_id):
	has_any_photo=False
	try:
		seeprofile=Profile.objects.get(user=User.objects.get(id=user_id))
	except Exception as e:
		seeprofile=None
	try:
		albums=Album.objects.filter(user=User.objects.get(id=user_id))
	except Exception as e:
		albums=None
	try:
		songs=Song.objects.filter(user=User.objects.get(id=user_id))
	except Exception as e:
		songs=None
	try:
		playlists=Playlist.objects.filter(user=User.objects.get(id=user_id))
	except Exception as e:
		playlists=None
	try:
		profile=Profile.objects.get(user=request.user)
	except Exception as e:
		profile=None
	try:
		is_friend=Friend.objects.get(follow=request.user,follower=user_id)
	except Exception as e:
		is_friend=None

	for playlist in playlists:
		if playlist.cover:
			has_any_photo=True
	for album in albums:
		if album.album_logo:
			has_any_photo=True

	return render(request,'account/profile.html',{'profile':profile,'seeprofile':seeprofile,'songs':songs,'playlists':playlists,'albums':albums,'has_any_photo':has_any_photo,'is_friend':is_friend})
def notify(request):
	newnotes=[]
	oldnotes=[]
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

	if last_notify and last_tracked_notify:
		for notification in reversed(notifications):
			if notification.id > last_tracked_notify.last_notify_index:
				newnotes.append(notification)
			else:
				oldnotes.append(notification)

	print(newnotes,oldnotes)

	try:
		if last_notify and last_tracked_notify:
			if last_notify.id is not last_tracked_notify.last_notify_index:
				notifytracker=TrackNotification.objects.create(user=request.user,last_notify_count=len(notifications),last_notify_index=list(reversed(notifications))[0].id,datetime=datetime.datetime.now())
	except Exception as e:
		raise e
	return render(request,"account/notify.html",{'notifications':notifications,'last_notify':last_notify,'last_tracked_notify':last_tracked_notify,'newnotes':newnotes,'oldnotes':oldnotes})

def logout_view(request):
	msgframe.add_message(request,msgframe.INFO,"You are logged Out.")
	logout(request)
	del request.session
	try:
		User.objects.get(username=user)
	except:
		return HttpResponseRedirect('/')
	return render(request,'music/logout.php',{})