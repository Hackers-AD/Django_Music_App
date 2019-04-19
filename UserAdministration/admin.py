from django.contrib import admin
from .models import *

# Register your models here.
class UserPhotoAdmin(admin.ModelAdmin):
	list_display=['user','profile_photo','cover_photo','image','file']
	list_filter=['user']

class ProfileAdmin(admin.ModelAdmin):
	list_display=['user','nick_name','birth_date','sex','country']
	list_filter=['country','birth_date']

class FriendAdmin(admin.ModelAdmin):
	list_display=['follow','follower','follow_perm','follower_perm','datetime']
	list_filter=['datetime']

class MessageAdmin(admin.ModelAdmin):
	list_display=['user','friends']
	list_filter=['user']

class ConversationAdmin(admin.ModelAdmin):
	list_display=['user','sent','received','datetime']
	list_filter=['datetime']

class NotificationAdmin(admin.ModelAdmin):
	list_display=['user','info','source_id','noteclass','datetime']
	list_filter=['datetime']

class UserTrackerAdmin(admin.ModelAdmin):
	list_display=['user','last_seen','active_status']
	list_filter=['last_seen']

class TrackNotificationAdmin(admin.ModelAdmin):
	list_display=['user','last_notify_count','last_notify_index','datetime']
	list_filter=['datetime']

admin.site.register(UserPhoto,UserPhotoAdmin)
admin.site.register(Profile,ProfileAdmin)
admin.site.register(Friend,FriendAdmin)
admin.site.register(Conversation,ConversationAdmin)
admin.site.register(Notification,NotificationAdmin)
admin.site.register(UserTracker,UserTrackerAdmin)
admin.site.register(Message,MessageAdmin)
admin.site.register(TrackNotification,TrackNotificationAdmin)