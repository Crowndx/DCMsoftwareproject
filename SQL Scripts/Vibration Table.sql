/****** Object:  Table [dbo].[Vibration]    Script Date: 4/22/2019 5:41:03 PM ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO

CREATE TABLE [dbo].[Vibration](
	[VibrationID] [int] IDENTITY(1,1) NOT NULL,
	[Vibration] [int] NOT NULL,
	[DateTime] [datetime] NOT NULL,
	[MotorID] [int] NOT NULL,
 CONSTRAINT [PK_Vibration] PRIMARY KEY CLUSTERED 
(
	[VibrationID] ASC
)WITH (STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY]
GO

ALTER TABLE [dbo].[Vibration]  WITH CHECK ADD  CONSTRAINT [FK_Vibration_Motor] FOREIGN KEY([MotorID])
REFERENCES [dbo].[Motor] ([MotorID])
GO

ALTER TABLE [dbo].[Vibration] CHECK CONSTRAINT [FK_Vibration_Motor]
GO


