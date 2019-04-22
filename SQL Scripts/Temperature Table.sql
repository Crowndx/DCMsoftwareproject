/****** Object:  Table [dbo].[Temperature]    Script Date: 4/22/2019 5:40:40 PM ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO

CREATE TABLE [dbo].[Temperature](
	[TemperatureID] [int] IDENTITY(1,1) NOT NULL,
	[Temperature] [int] NOT NULL,
	[DateTime] [datetime] NOT NULL,
	[MotorID] [int] NOT NULL,
 CONSTRAINT [PK_Temperature] PRIMARY KEY CLUSTERED 
(
	[TemperatureID] ASC
)WITH (STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY]
GO

ALTER TABLE [dbo].[Temperature]  WITH CHECK ADD  CONSTRAINT [FK_Temperature_Motor] FOREIGN KEY([MotorID])
REFERENCES [dbo].[Motor] ([MotorID])
GO

ALTER TABLE [dbo].[Temperature] CHECK CONSTRAINT [FK_Temperature_Motor]
GO


