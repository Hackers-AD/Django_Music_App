# -*- coding: utf-8 -*-
# Generated by Django 1.11 on 2019-02-15 12:12
from __future__ import unicode_literals

from django.db import migrations, models


class Migration(migrations.Migration):

    dependencies = [
        ('Music', '0004_auto_20190214_2134'),
    ]

    operations = [
        migrations.AddField(
            model_name='playlist',
            name='cover',
            field=models.ImageField(blank=True, upload_to='music/playlist/cover'),
        ),
        migrations.AddField(
            model_name='playlist',
            name='is_favourite',
            field=models.BooleanField(default=False),
        ),
        migrations.AddField(
            model_name='playlist',
            name='song_number',
            field=models.IntegerField(blank=True, default=0),
        ),
    ]
