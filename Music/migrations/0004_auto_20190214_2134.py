# -*- coding: utf-8 -*-
# Generated by Django 1.11 on 2019-02-14 15:49
from __future__ import unicode_literals

from django.db import migrations, models


class Migration(migrations.Migration):

    dependencies = [
        ('Music', '0003_auto_20190214_1627'),
    ]

    operations = [
        migrations.AlterField(
            model_name='song',
            name='album_id',
            field=models.CharField(blank=True, max_length=5000),
        ),
        migrations.AlterField(
            model_name='song',
            name='playlist_id',
            field=models.CharField(blank=True, max_length=5000),
        ),
    ]