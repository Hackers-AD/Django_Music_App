from django.conf.urls import url,include
from django.conf import settings
from django.conf.urls.static import static
from . import views

urlpatterns = [
    url(r'^login/$',views.login_view,name='login'),
    url(r'^logout/$', views.logout_view,name='logout'),
    url(r'^signup/$', views.signup,name='signup'),
    url(r'^notify/$', views.notify,name='notify'),
    url(r'^message/(?P<msg_id>[0-9]*)$',views.message,name="message"),
    url(r'^profile/(?P<user_id>[0-9]*)/$',views.seeprofile,name="seeprofile"),
    url(r'^addfriend/$',views.addfriend,name="addfriend"),
    url(r'^recentmessage/$',views.messagelist,name="messagelist"),
    url(r'^activefriend/$',views.activefriend,name="activefriend"),
    url(r'^conversation/(?P<msg_id>[0-9]+)/$',views.conversation,name="conversation"),
    url(r'^recordmsg/(?P<msg_id>[0-9]+)/$',views.recordmsg,name="recordmsg"),
    url(r'^msgimage/(?P<conv_id>[0-9]+)/(?P<msg_id>[0-9]+)/$',views.msgimage,name="msgimage"),
    url(r'^refresh_message/(?P<msg_id>[0-9]+)/(?P<old_count>[0-9]+)/$',views.refreshmsg,name="refreshmsg"),
]+static(settings.MEDIA_URL,document_root=settings.MEDIA_ROOT)
