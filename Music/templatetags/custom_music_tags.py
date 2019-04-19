from django import template
from UserAdministration.models import *
from django.contrib.auth.models import User, Group
from django.http import HttpRequest

register = template.Library()

@register.filter
def has_profile_photo(user,value):
	try:
		profile=Profile.objects.get(user=user)
	except Exception as e:
		profile=None
	if profile:
		if profile.profile_photo:
			return True

	return False

@register.filter
def is_in_album(song,album_id):
	ids=song.album_id.split(",")
	for x in ids:
		if x==album_id:
			return True

	return False

@register.filter
def is_in_playlist(song,playlist_id):
	ids=song.playlist_id.split(",")
	for x in ids:
		if x==playlist_id:
			return True

	return False