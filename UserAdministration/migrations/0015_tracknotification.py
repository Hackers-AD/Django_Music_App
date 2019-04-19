# Generated by Django 2.1.7 on 2019-03-06 13:17

from django.conf import settings
from django.db import migrations, models
import django.db.models.deletion


class Migration(migrations.Migration):

    dependencies = [
        migrations.swappable_dependency(settings.AUTH_USER_MODEL),
        ('UserAdministration', '0014_notification_noteclass'),
    ]

    operations = [
        migrations.CreateModel(
            name='TrackNotification',
            fields=[
                ('id', models.AutoField(auto_created=True, primary_key=True, serialize=False, verbose_name='ID')),
                ('last_notify_count', models.IntegerField(blank=True, default=0)),
                ('last_notify_index', models.IntegerField(blank=True, default=0)),
                ('datetime', models.DateTimeField(blank=True, null=True)),
                ('user', models.ForeignKey(on_delete=django.db.models.deletion.CASCADE, to=settings.AUTH_USER_MODEL)),
            ],
        ),
    ]
