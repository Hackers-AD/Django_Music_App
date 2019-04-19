import datetime
from django.http import request,HttpResponseRedirect
from django.core.cache import cache
from django.conf import settings
from django.shortcuts import redirect,render
from UserAdministration import views as userview
from Music import views as musicview
from UserAdministration.models import *
from Music.models import *
from .models import *
import datetime

class ActiveUser:
	def __init__(self,get_response):
		self.get_response=get_response

	def __call__(self,request):
		response=self.get_response(request)
		return response

	def process_request(self,request):
		return None

	def process_view(self,request,view_func,args,kwargs):
		try:
			tracked_user=UserTracker.objects.get(user=request.user)
			if tracked_user.active_status:
				now=datetime.datetime.now()
				tracked_user.last_seen=now
				tracked_user.save()
			#print("tracking existing user",tracked_user.user)
		except Exception as e:
			print("Tracked User is Anonynomous")
		return None

class Notification:
	def __init__(self,get_response):
		self.get_response=get_response

	def __call__(self,request):
		response=self.get_response(request)
		return response

	def process_request(self,request):
		return None

	def process_view(self,request,view_func,args,kwargs):
		if view_func==userview.addfriend:
			pass
		if view_func==userview.recordmsg:
			message=None
			if request.method=='POST':
				if request.POST.get('message',""):
					message=request.POST['message']
				if request.FILES.get('image',""):
					image=request.FILES['image']
				if request.FILES.get('file',""):
					file=request.FILES['file']
				if request.POST.get('thumbsup',""):
					like=request.POST['thumbsup']
				if message or image or file or like:
					pass
				
		return None
		