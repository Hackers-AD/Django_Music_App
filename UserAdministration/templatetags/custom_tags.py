from django import template
from UserAdministration.models import *
from django.contrib.auth.models import User, Group
from django.http import HttpRequest

register = template.Library()

@register.simple_tag
def refresh_message(msg_id,count_message,requestuser):
	print(msg_id,count_message,requestuser)
	conversations=None
	try:
		message=Message.objects.get(user=requestuser,friends=msg_id)
		conversations=Conversation.objects.get(user=message)
	except Exception as e:
		message=None
	print(conversations)

	if conversations:
		if len(conversations)>count_message:
			return "true"
	return "false"