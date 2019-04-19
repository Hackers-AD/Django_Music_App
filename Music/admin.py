from django.contrib import admin
from .models import *

# Register your models here.
class AlbumAdmin(admin.ModelAdmin):
	list_display=['user','album_title','likes','dislikes','published_date']

class PlaylistAdmin(admin.ModelAdmin):
	list_display=['user','name','created_date']

class SongAdmin(admin.ModelAdmin):
	list_display=['user','song_title','song_artist','likes','dislikes','downloads','album_id','playlist_id','date']

class FeedAdmin(admin.ModelAdmin):
	list_display=['user','song_id','album_id','likes','dislikes']

class CommentAdmin(admin.ModelAdmin):
	list_display=['user','song_id','album_id','comment','datetime']

		
admin.site.register(Album,AlbumAdmin)
admin.site.register(Playlist,PlaylistAdmin)
admin.site.register(Song,SongAdmin)
admin.site.register(Feed,FeedAdmin)
admin.site.register(Comment,CommentAdmin)