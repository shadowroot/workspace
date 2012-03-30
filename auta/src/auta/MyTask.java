package auta;

import java.awt.Graphics;
import java.awt.Panel;
import java.util.Date;
import java.util.TimerTask;

public class MyTask extends TimerTask{
	
	private static Date start_time = null;
	private static Date end_time = null;
	private static long diff = 0;
	private static Panel panelMain = null;
	private static long minute,second,milis=0;
	private static Graphics g;
	public void run(){
		
		panelMain = run.getPanel();
		g = panelMain.getGraphics();
		draw_time();
	
	}
	
	public static void add_time(Date start,Date end){
		start_time = start;
		end_time = end;
		diff = (end_time.getTime() - start_time.getTime());
		
		second = (long)diff/1000;
		minute = (long)(diff/1000)/60;
		milis = (long)diff - (second*1000+minute*60*1000);
		

	}

	private void draw_time(){
		
		Date now = new Date();
		g.drawString(now.toString(), 10, 10);
		panelMain.update(g);
	
	}
}